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
							{{UnitMaker::radio_btn([
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
							{{-- {{UnitMaker::radio_btn([
								'name' => $model.'[is_home]',
								'title' => 'H-是否顯示於首頁',
								'value' => ( !empty($data['is_home']) )? $data['is_home'] : '',
								'tip' => '決定資料是否顯示於首頁的設定。',
							])}} --}}
							{{UnitMaker::numberInput([
								'name' => $model.'[rank]',
								'title' => '排序',
								'tip' => '列表顯示排序，輸入 0 為置頂，排序將超越 1 ，多筆設定為 0 ，最後排序將取決於資料建立日期。',
								'value' => ( !empty($data['rank']) )? $data['rank'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title]',
								'title' => '分類名稱',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['title']) )? $data['title'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title2]',
								'title' => '分類副名稱',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['title2']) )? $data['title2'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[url_title]',
								'title' => '網址關鍵字',
								'tip' => '此分類網址名稱，可使用中文，不可留白有空格、不可重複、不可使用特殊符號如「;　/　?　:　@　=　&　<　>　"　#　%　{　}　|　\　^　~　[　]　`　」',
								'value' => ( !empty($data['url_title']) )? $data['url_title'] : ''
							])}}
							{{-- {{UnitMaker::textArea([
								'name' => $model.'[intro]',
								'title' => '分類介紹',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['intro']) )? $data['intro'] : ''
							])}}	 --}}

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