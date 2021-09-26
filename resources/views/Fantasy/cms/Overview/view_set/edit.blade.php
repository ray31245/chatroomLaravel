@if(config('cms.New') == true)
	<form id="{{$formKey}}" class="" action="">
	<input type="hidden" name="page" value="{{$page}}">
	<div style="display: none;" class="form-set" data-page="{{$page}}" data-showtitle="{{( !empty($data['title']) )? $data['title'] : '新增未命名資料'}}" data-mod="{{( !empty($data['id']) )? 'update' : 'create'}}"></div>
@endif

{{-- 表名跟哪一筆資料 --}}
<input type="hidden" name="modelName" value="{{ $model }}">
@if(isset($data['id']))
	<input type="hidden" name="dataId" value="{{ $data['id'] }}" class="editContentDataId">
@else
	<input type="hidden" name="dataId" value="" class="editContentDataId">
@endif
<input type="hidden" name="{{$model}}[branch_id]" value="{{$baseBranchId}}">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
@php
	$tips_txt = '建議填寫格式:/語系/單元<br>語系:繁中=>tw<br>單元:<br>最新消息=>News<br>關於我們=>About<br>產品資訊=>Product<br>聯絡我們=>Contact<br>線上維修=>Service<br>';
@endphp
{{-- 內容 --}}
<div class="backEnd_quill">
	<article class="work_frame">
		<section class="content_box">
		    <div class="for_ajax_content">
		      	<section class="content_a">
		        	<ul class="frame">

						@if($formKey == 'aForm')

							{{UnitMaker::reviewed_radio_btn([
								'need_review' => $need_review,
								'can_review' => $can_review,
								'name' => $model.'[is_reviewed]',
								'value' => ( !empty($data['is_reviewed']) )? $data['is_reviewed'] : ''
							])}}
							{{-- {{UnitMaker::radio_btn([
								'name' => $model.'[is_visible]',
								'title' => 'S-是否顯示',
								'value' => ( !empty($data['is_visible']) )? $data['is_visible'] : '',
								'tip' => '主要決定資料是否於前端網頁發佈的設定，設定不發佈，資料將不會出現在任一頁面上，也無法被搜尋引擎尋找。',
							])}}							
							{{UnitMaker::radio_btn([
								'name' => $model.'[is_preview]',
								'title' => 'R-是否顯示於預覽站',
								'tip' => '主要決定資料是否於預覽站發佈的設定，與是否顯示於正式網頁無關。',
								'value' => ( !empty($data['is_preview']) )? $data['is_preview'] : ''
							])}}
							{{UnitMaker::numberInput([
								'name' => $model.'[rank]',
								'title' => '排序',
								'tip' => '列表顯示排序，輸入 0 為置頂，排序將超越 1 ，多筆設定為 0 ，最後排序將取決於資料建立日期。',
								'value' => ( !empty($data['rank']) )? $data['rank'] : ''
							])}} --}}

							@if (in_array($data['view_set_key'],['News','Contact','Service','product','About']))
								{{UnitMaker::textInput([
									'name' => $model.'[banner_title]',
									'title' => 'BANNER標題',
									'value' => ( !empty($data['banner_title']) )? $data['banner_title'] : '',
									'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
								])}}
								{{UnitMaker::textInput([
									'name' => $model.'[banner_sub_title]',
									'title' => 'BANNER標題二',
									'value' => ( !empty($data['banner_sub_title']) )? $data['banner_sub_title'] : '',
									'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。',
								])}}
							@endif
							@if (in_array($data['view_set_key'],['News']))
								@php
								// 不傷滑鼠滾輪就讓行數少一點吧
								$conset = [
									['type'=>'textInput','colum'=>'bak_title_1','title'=>'切換分類題提示文字','tip'=>'','tip_add'=>'<br>顯示在手機版'],
									['type'=>'textInput','colum'=>'view_title','title'=>'頁面標題','tip'=>'','tip_add'=>''],
									['type'=>'textInput','colum'=>'view_title_sub','title'=>'頁面標題二','tip'=>'','tip_add'=>''],
									['type'=>'textInput','colum'=>'bak_title_2','title'=>'分享項目提示文字','tip'=>'','tip_add'=>''],
									['type'=>'textInput','colum'=>'bak_title_3','title'=>'相關產品區塊標題','tip'=>'','tip_add'=>''],
									['type'=>'textInput','colum'=>'bak_title_4','title'=>'相關產品區塊標題二','tip'=>'','tip_add'=>''],
								];
								@endphp
								@include('Fantasy.cms.makeUnitMaker',['conset'=>$conset])
							@endif
						@elseif($formKey == 'bForm')
						@elseif($formKey == 'cForm')
						@elseif($formKey == 'dForm')
						@elseif($formKey == 'eForm')
						@endif

					</ul>
				</section>
			</div>
		</section>
	</article>
</div>


@if(config('cms.New') == true)
	</form>
@endif
<script>
	// 因為aForm是第一個被載入的
	@if ($formKey == 'aForm')
		// 一開始除了aForm以外預設都是隱藏的，有要顯示再這邊一個一個加
		@if(!in_array($data['view_set_key'],['Contact','Service','Home','NavExtend','Menu','product','MemberLogin','MemberSigup','MemberCenter','MemberAccount']))
			$('li[data-form="bForm"]').hide();
		@endif
		@if(!in_array($data['view_set_key'],['Contact','Service','Home','product','MemberLogin','MemberSigup','MemberCenter','MemberAccount']))
			$('li[data-form="cForm"]').hide();
		@endif
		@if (!in_array($data['view_set_key'],['Service','product','MemberLogin','MemberSigup','MemberCenter']))
			$('li[data-form="dForm"]').hide();
		@endif
		@if (!in_array($data['view_set_key'],['MemberLogin']))
			$('li[data-form="eForm"]').hide();
		@endif
			// 把每個formname的名稱都重製回去
			try {
				$('li[data-form]').each(function name(params) {
					$(this).children('a').children('p').text(form_txt_arr[$(this).attr('data-form')]);
				});
			} catch (error) {
				var form_txt_arr = [];
				$('li[data-form]').each(function name(params) {
					form_txt_arr[$(this).attr('data-form')] = $(this).children('a').children('p').text();
					console.log(form_txt_arr);
				});
			}
		// 每個formname都可以改
		@if ($data['view_set_key']=='MemberAccount') 
			$('li[data-form="aForm"] a p').text('會員帳號管理設定');
			$('li[data-form="bForm"] a p').text('修該密碼燈箱');
			$('li[data-form="cForm"] a p').text('停用帳號燈箱');
			// $('li[data-form="dForm"] a p').text('步驟二設定');
			// $('li[data-form="eForm"] a p').text('步驟三設定');
		@endif
	@endif
</script>