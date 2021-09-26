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
							{{UnitMaker::select2([
								'name' => $model.'[category]',
								'title' => '所屬分類',
								'options' => $options['CharityCategory'],
								'value' => ( !empty($data['category']) )? $data['category'] : '',
								'tip' => '選擇此公益所屬的分類。'
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title]',
								'title' => '公益標題',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['title']) )? $data['title'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[url_title]',
								'title' => '網址關鍵字',
								'tip' => '此分類網址名稱，可使用中文，不可留白有空格、不可重複、不可使用特殊符號如「;　/　?　:　@　=　&　<　>　"　#　%　{　}　|　\　^　~　[　]　`　」',
								'value' => ( !empty($data['url_title']) )? $data['url_title'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[intro]',
								'title' => '列表短述',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['intro']) )? $data['intro'] : ''
							])}}
							{{UnitMaker::imageGroup([
								'title' => '公益列表圖',
								'image_array' =>
								[
									[
										'name' => $model.'[img]',
										'title' => '列表縮圖',
										'value' => ( !empty($data['img']) )? $data['img'] : '',
										'set_size' => 'yes',
										'width' => '470',
										'height' => '285',
									],
								],
								'tip' => '圖片建議尺寸 470 x 285 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}					

						@elseif($formKey == 'bForm')

							{{UnitMaker::textInput([
								'name' => $model.'[date]',
								'title' => '公益時間',
								'tip' => '此處可任意填寫公益時程。',
								'value' => ( !empty($data['date']) )? $data['date'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[location]',
								'title' => '公益地點',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['location']) )? $data['location'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[government]',
								'title' => '合作單位',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['government']) )? $data['government'] : ''
							])}}

						@elseif($formKey == 'cForm')

							@include('Fantasy.cms.back_article',['Model'=> 'CharityArticle','ThreeModel'=>'CharityArticleThree'])		
						@elseif($formKey == 'dForm')

							{{UnitMaker::WNsonTable([
								'sort' => 'yes',//是否可以調整順序
								'teach' => 'no',
								'hasContent' => 'yes', //是否可展開
								'tip' => '精彩回顧編輯',
								'create' => 'yes', //是否可新增
								'delete' => 'yes', //是否可刪除
								'value' => ( !empty($associationData['son']['CharityYear']) )? $associationData['son']['CharityYear'] : [],
								'name' => 'CharityYear',
								'tableSet' => 
								[
									//tableSet元件        
									[
										'type' => 'just_show',
										'title' => '年分',
										'value' => 'year',										
									],
									[
										'type' => 'radio_btn',
										'title' => '是否顯示',
										'value' => 'is_visible',
									]
								],
								'tabSet'=>
								[	
									[
										'title' => '內容編輯',
										'content' => 
										[
											//內容元件	
											[
												'type' => 'textInput',
												'title' => '年分',
												'value' => 'year',
												'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
											],
										],
									],
									[
										'title' => '輪播圖管理',
										'content' => [],
										'is_three' => 'yes',
										'three_model' => 'CharityYearBanner',
										'three' =>
										[
											'title' => '圖片管理',
											'tip' => '',
											'SecondIdColumn' => 'second_id', //存放第二層ID的欄位
											'three_content' => 
											[		
												[
													'type' => 'textInput',
													'title' => '標題',
													'value' => 'title',
													'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
												],
												[
													'type' => 'image_group',
													'title' => '圖片',
													'tip' => '',
													'image_array' => 
													[
														[
															'title' => '圖片',
															'value' => 'img',
															'set_size' => 'no',
														]
													]
												],								
											]
										],
									],
									[
										'title' => '事件管理',
										'content' => [],
										'is_three' => 'yes',
										'three_model' => 'CharityYearEvent',
										'three' =>
										[
											'title' => '事件管理',
											'tip' => '',
											'SecondIdColumn' => 'second_id', //存放第二層ID的欄位
											'three_content' => 
											[		
												[
													'type' => 'textInput',
													'title' => '事件標題',
													'value' => 'title',
													'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
												],
												[
													'type' => 'textArea',
													'title' => '事件介紹',
													'value' => 'intro',
													'tip' => '可輸入多行文字，內容不支援HTML及CSS、JQ、JS等語法，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放。'
												],
												[
													'type' => 'datePicker',
													'title' => '起始日期',
													'value' => 'date_start',
												],		
												[
													'type' => 'datePicker',
													'title' => '結束日期',
													'value' => 'date_end',
													'tip' => '若無填寫則僅顯示起始日期。'
												],								
											]
										],
									],
								]
							])}}

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