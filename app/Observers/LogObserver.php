<?php
namespace App\Observers;

use DB;
use Route;
use Session;
use BaseFunction;
class LogObserver
{
	
	//不用記錄的表
	const DisableTable =       
    [
		"tw_loginrecord",
		"fourm_summary",
		"fourm_summary_reply",
		"member_log",
		"member_browse_application",
		"member_browse_product",
        "tw_news_file",
    ];
	//記錄分類 AMS / FMS / CMS / Login / 若有其他分類需求請在下面自行增加陣列
	const TableList =       
    [
		[
			"Class"=>"AMS",
			"Table"=>[
				"basic_ams_role",
				"basic_cms_role",
				"basic_fantasy_users",
			]
		],
		[
			"Class"=>"FMS",
			"Table"=>[
				"basic_fms_file",
				"basic_fms_first",
				"basic_fms_second",
				"basic_fms_third",
				"basic_fms_zero",
			]
		]
    ];
	function utf8_str_split($str, $split_len = 1)
	{
		if (!preg_match('/^[0-9]+$/', $split_len) || $split_len < 1)
			return FALSE;
	 
		$len = mb_strlen($str, 'UTF-8');
		if ($len <= $split_len)
			return array($str);
	 
		preg_match_all('/.{'.$split_len.'}|[^\x00]{1,'.$split_len.'}$/us', $str, $ar);
	 
		return $ar[0];
	}
	function print_mem()
	{
	   /* Currently used memory */
	   $mem_usage = memory_get_usage();
	   
	   /* Peak memory usage */
	   $mem_peak = memory_get_peak_usage();

	   echo 'The script is now using: <strong>' . round($mem_usage / 1024) . 'KB</strong> of memory.<br>';
	   echo 'Peak usage: <strong>' . round($mem_peak / 1024) . 'KB</strong> of memory.<br><br>';
	}
	function computeDiff($from, $to)
	{
		$diffValues = $diffMask = $dm = array();
		$n1 = count($from);
		$n2 = count($to);
		//echo self::print_mem();
		for ($j = -1; $j < $n2; $j++) $dm[-1][$j] = 0;
		for ($i = -1; $i < $n1; $i++) $dm[$i][-1] = 0;
		for ($i = 0; $i < $n1; $i++)
		{
			for ($j = 0; $j < $n2; $j++)
			{
				if ($from[$i] == $to[$j])
				{
					$ad = $dm[$i - 1][$j - 1];
					$dm[$i][$j] = $ad + 1;
				}
				else
				{
					$a1 = $dm[$i - 1][$j];
					$a2 = $dm[$i][$j - 1];
					$dm[$i][$j] = max($a1, $a2);
				}
			}
		}
		//echo self::print_mem();
		$i = $n1 - 1;
		$j = $n2 - 1;
		while (($i > -1) || ($j > -1))
		{
			if ($j > -1)
			{
				if ($dm[$i][$j - 1] == $dm[$i][$j])
				{
					$diffValues[] = $to[$j];
					$diffMask[] = 1;
					$j--;  
					continue;              
				}
			}
			if ($i > -1)
			{
				if ($dm[$i - 1][$j] == $dm[$i][$j])
				{
					$diffValues[] = $from[$i];
					$diffMask[] = -1;
					$i--;
					continue;              
				}
			}
			{
				$diffValues[] = $from[$i];
				$diffMask[] = 0;
				$i--;
				$j--;
			}
		}    
		$diffValues = array_reverse($diffValues);
		$diffMask = array_reverse($diffMask);
		return array('values' => $diffValues, 'mask' => $diffMask);
	}
	function diffline($line1, $line2)
	{
		$line1 = self::utf8_str_split(str_replace('"', '', $line1),50);
		$line2 = self::utf8_str_split(str_replace('"', '', $line2),50);
		$max = max(count($line1), count($line2));
		$result = '';
		for($i = 0;$i < $max;$i++){
			$diff = self::computeDiff(self::utf8_str_split($line1[$i]), self::utf8_str_split($line2[$i]));
			$diffval = $diff['values'];
			$diffmask = $diff['mask'];
			$n = count($diffval);
			$pmc = 0;
			
			for ($i = 0; $i < $n; $i++)
			{
				$mc = $diffmask[$i];
				if ($mc != $pmc)
				{
					switch ($mc)
					{
						case -1: $result .= '<del>'; break;
						case 1: $result .= '<ins>'; break;
					}
				}
				if($mc != 0){
					$result .= $diffval[$i];
				}
				$pmc = $mc;
			}
		}
		return $result;
	}
	//public function creating($FmsFile){		dd("creating");}
	//public function created($Data){}
	public function updating($Data){	
		$DisableTable = array_map('strtolower', self::DisableTable);
		if(!in_array(strtolower($Data->getTable()),$DisableTable) && Session::get('fantasy_user.id') !== null){
			$attributes = $Data->getAttributes();
			$dirty = $Data->getDirty();
			if (count($dirty) > 0) {            
				if(empty($attributes['create_id'])){
					$Data->setAttribute('create_id', Session::get('fantasy_user.id'));
				}
			}	
		}
	}
	public function updated($Data){
		$staticPrefix = Route::getCurrentRequest()->route()->getCompiled()->getStaticPrefix();
		if($staticPrefix == "/Fantasy"){
		$DisableTable = array_map('strtolower', self::DisableTable);
			if(!in_array(strtolower($Data->getTable()),$DisableTable) && Session::get('fantasy_user.id') !== null){
				$attributes = $Data->getAttributes();
				$Original = $Data->getOriginal();
				//判斷分類
				$TableClassName = "";
				foreach(self::TableList as $val){
					foreach($val['Table'] as $TableVal){
						if($TableVal == $Data->getTable()){
							$TableClassName = $val['Class'];
						}
					}
				}
				//如果是舊資料沒有創建者，視為新增
				if(empty($Original['create_id'])){
					$attributes_en = json_encode($attributes,JSON_UNESCAPED_UNICODE);
					BaseFunction::writeLogData('insert', ['table'=>$Data->getTable(), 'id'=>$attributes['id'],'ChangeData'=>$attributes_en,'classname'=>$TableClassName]);
				}else{
					//更新
					$diffline = [];
					$dirty = $Data->getDirty();
					//從不同的資料去比對舊資料
					foreach($dirty as $key=>$val){
						if($key != "updated_at"){
							$diffCallBack = self::diffline($Original[$key],$dirty[$key]);
							//找此欄位的備註
							$DB_Table_Note = DB::select('show FULL columns from '.$Data->getTable());
							$note = "";
							foreach($DB_Table_Note as $noteval){
								if($noteval->Field == $key){
									$note = $noteval->Comment;
									break;
								}
							}						
							$diffline[] = ['f'=>$key,'n'=>$note,'d'=>$diffCallBack];
						}
					}
					$diffline_en = json_encode($diffline,JSON_UNESCAPED_UNICODE);	
					BaseFunction::writeLogData('edit', ['table'=>$Data->getTable(), 'id'=>$attributes['id'],'ChangeData'=>$diffline_en,'classname'=>$TableClassName]);
				}

			}
		}
	}
	public function saving($Data){
		$DisableTable = array_map('strtolower', self::DisableTable);
		if(!in_array(strtolower($Data->getTable()),$DisableTable) && Session::get('fantasy_user.id') !== null){
			$attributes = $Data->getAttributes();
			$dirty = $Data->getDirty();
			if (count($dirty) > 0) {   
				if(empty($attributes['create_id'])){
					$Data->setattribute('create_id', session::get('fantasy_user.id'));
				}
			}	
		}
	}
	
	public function saved($Data){
		//資料沒更新 & 首次新增
		$staticPrefix = Route::getCurrentRequest()->route()->getCompiled()->getStaticPrefix();
		if($staticPrefix == "/Fantasy"){
			$DisableTable = array_map('strtolower', self::DisableTable);
			if(!in_array(strtolower($Data->getTable()),$DisableTable) && Session::get('fantasy_user.id') !== null){
				$attributes = $Data->getAttributes(); //新資料
				$Original = $Data->getOriginal(); //舊資料
				$attributes_en = json_encode($attributes,JSON_UNESCAPED_UNICODE);
				//判斷分類
				$TableClassName = "";
				foreach(self::TableList as $val){
					foreach($val['Table'] as $TableVal){
						if($TableVal == $Data->getTable()){
							$TableClassName = $val['Class'];
						}
					}
				}
				//如果沒有舊資料,表示新增資料
				if(empty($Original)){
					if(!empty($attributes['create_id'])){
						BaseFunction::writeLogData('insert', ['table'=>$Data->getTable(), 'id'=>$attributes['id'],'ChangeData'=>$attributes_en,'classname'=>$TableClassName]);
					}
				}
			}
		}
	}
	////public function deleting($FmsFile){		dd("deleting");}
	public function deleted($Data){		
		$DisableTable = array_map('strtolower', self::DisableTable);
		if(!in_array(strtolower($Data->getTable()),$DisableTable) && Session::get('fantasy_user.id') !== null){
			$attributes = $Data->getAttributes();
			$attributes_en = json_encode($attributes,JSON_UNESCAPED_UNICODE);
			//判斷分類
			$TableClassName = "";
			foreach(self::TableList as $val){
				foreach($val['Table'] as $TableVal){
					if($TableVal == $Data->getTable()){
						$TableClassName = $val['Class'];
					}
				}
			}
			BaseFunction::writeLogData('del', ['table'=>$Data->getTable(), 'id'=>$attributes['id'],'ChangeData'=>$attributes_en,'classname'=>$TableClassName]);
		}
	}
	//public function restoring($FmsFile){	dd("restoring");}
	//public function restored($FmsFile){		dd("restored");}
}