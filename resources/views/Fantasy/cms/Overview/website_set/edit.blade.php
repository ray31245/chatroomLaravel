{{-- 表名跟哪一筆資料 --}}
<input type="hidden" name="modelName" value="{{ $model }}">
@if(isset($data['id']))
	<input type="hidden" name="dataId" value="{{ $data['id'] }}" class="editContentDataId">
@else
	<input type="hidden" name="dataId" value="" class="editContentDataId">
@endif
<input type="hidden" name="{{$model}}[branch_id]" value="{{$baseBranchId}}">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

<!--內容-->
<div class="backEnd_quill">
	<article class="work_frame">
		<section class="content_box">
		    <div class="for_ajax_content">
		      	<section class="content_a">
		        	<ul class="frame">

						@if($formKey == 'basicForm')

							{{UnitMaker::textInput([
								'name' => $model.'[email]',
								'title' => '聯絡Email',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['email']) )? $data['email'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[tel]',
								'title' => '電話',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['tel']) )? $data['tel'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[fax]',
								'title' => '傳真',
								'value' => ( !empty($data['fax']) )? $data['fax'] : '',
								'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[time]',
								'title' => '開放時間',
								'tip' => '單行輸入，格式為：<br>"Mo-Th 11:00-22:00","Fr 11:00-22:30","Sa 10:30-22:30","Su 10:30-22:00"。',
								'value' => ( !empty($data['time']) )? $data['time'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[price]',
								'title' => '商品價格區間',
								'tip' => '請輸入商品價格區間。',
								'value' => ( !empty($data['price']) )? $data['price'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[post]',
								'title' => '郵遞區號',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['post']) )? $data['post'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[region]',
								'title' => '城市',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['region']) )? $data['region'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[locality]',
								'title' => '區',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['locality']) )? $data['locality'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[address]',
								'title' => '地址',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['address']) )? $data['address'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[lng]',
								'title' => '經度',
								'tip' => '請輸入公司所在經度，範圍為±180。',
								'value' => ( !empty($data['lng']) )? $data['lng'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[lat]',
								'title' => '緯度',
								'tip' => '請輸入公司所在緯度，範圍為±90。',
								'value' => ( !empty($data['lat']) )? $data['lat'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[map]',
								'title' => 'Google Map連結',
								'tip' => '請輸入地圖連結網址。',
								'value' => ( !empty($data['map']) )? $data['map'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[line]',
								'title' => '請填入line網址',
								'value' => ( !empty($data['line']) )? $data['line'] : '',
								'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
							])}}							
							{{UnitMaker::textInput([
								'name' => $model.'[facebook]',
								'title' => '請填入facebook網址',
								'value' => ( !empty($data['facebook']) )? $data['facebook'] : '',
								'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
							])}}							
							{{UnitMaker::textInput([
								'name' => $model.'[instagram]',
								'title' => '請填入instagram網址',
								'value' => ( !empty($data['instagram']) )? $data['instagram'] : '',
								'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
							])}}							
							{{UnitMaker::textInput([
								'name' => $model.'[youtube]',
								'title' => '請填入youtube網址',
								'value' => ( !empty($data['youtube']) )? $data['youtube'] : '',
								'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
							])}}							
							{{UnitMaker::textInput([
								'name' => $model.'[twitter]',
								'title' => '請填入twitter網址',
								'value' => ( !empty($data['twitter']) )? $data['twitter'] : '',
								'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
							])}}		
							{{UnitMaker::textInput([
								'name' => $model.'[wechat]',
								'title' => '請填入微信網址',
								'value' => ( !empty($data['wechat']) )? $data['wechat'] : '',
								'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
							])}}					
						
						@endif

					</ul>
				</section>
			</div>
		</section>
	</article>
</div>