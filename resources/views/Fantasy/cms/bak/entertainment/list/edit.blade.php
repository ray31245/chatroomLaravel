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
								'options' => $options['EntertainmentCategory'],
								'value' => ( !empty($data['category']) )? $data['category'] : '',
								'tip' => '選擇此娛樂所屬的分類。'
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title]',
								'title' => '娛樂標題',
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
							{{UnitMaker::select2([
								'name' => $model.'[type]',
								'title' => '列表樣式',
								'options' => config('options.EntertainmentType'),
								'value' => ( !empty($data['type']) )? $data['type'] : '',
								'tip' => '請務必選擇於列表顯示的樣式。'
							])}}
							{{UnitMaker::imageGroup([
								'title' => '娛樂列表圖',
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
								'tip' => '圖片建議尺寸：<br>小圖 470 x 285 像素<br>大圖 690 x 420 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}					

						@elseif($formKey == 'bForm')

							{{UnitMaker::datePicker([
								'name' => $model.'[date]',
								'title' => '娛樂時間',
								'tip' => '前台資料排序以此欄位為主，日期相同時以排序為輔，此欄位顯示於列表日期區塊。',
								'value' => ( !empty($data['date']) )? $data['date'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[location]',
								'title' => '娛樂地點',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['location']) )? $data['location'] : ''
							])}}

						@elseif($formKey == 'cForm')
							
							{{UnitMaker::WNsonTable([
								'sort' => 'yes',
								'teach' => 'no',
								'MultiImgcreate' => 'yes', //使用多筆圖片						
								'imageColumn' => 'img',  //預設圖片欄位
								'hasContent' => 'yes',
								'tip' => '內頁Banner輪播圖管理',
								'value' => ( !empty($associationData['son']['EntertainmentBanner']) )? $associationData['son']['EntertainmentBanner'] : [],
								'name' => 'EntertainmentBanner',
								'tableSet' => 
								[
									[
										'type' => 'filesText',
										'title' => '圖片',
										'value' => 'img',
									],
									[
										'type' => 'just_show',
										'title' => '標題',
										'value' => 'title',
										'default' => ''
									],
									[
										'type' => 'radio_btn',
										'title' => '是否顯示',
										'value' => 'is_visible',
										'default' => ''
									]
								],
								'tabSet'=>
								[
									[
										'title' => '基本設定',
										'content' => 
										[
											[
												'type' => 'image_group',
												'title' => '圖片',
												'tip' => '圖片建議尺寸：745 x 450 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
												'image_array' => 
												[
													[
														'title' => '圖片',
														'value' => 'img',
														'set_size' => 'no',
														'width' => '1040',
														'height' => '580',
													]
												]
											],
											[
												'type' => 'textInput',
												'title' => '標題',
												'value' => 'title',
												'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
												'default' => ''
											],
										],
									]
								]
							])}}

						@elseif($formKey == 'eForm')

							@include('Fantasy.cms.back_article',['Model'=> 'EntertainmentArticle','ThreeModel'=>'EntertainmentArticleThree'])

						@elseif($formKey == 'fForm')

							{{UnitMaker::select2([
								'name' => $model.'[related_book]',
								'title' => '相關繪本',
								'tip' => '選擇相關繪本',
								'options' => $options['Work'],
								'value' => ( !empty($data['related_book']) )? $data['related_book'] : ''
							])}}
						
						@elseif($formKey == 'gForm')

							{{UnitMaker::WNsonTable([
								'sort' => 'yes',
								'teach' => 'no',
								'hasContent' => 'yes',
								'tip' => '製作團隊管理',
								'value' => ( !empty($associationData['son']['EntertainmentStaff']) )? $associationData['son']['EntertainmentStaff'] : [],
								'name' => 'EntertainmentStaff',
								'tableSet' => 
								[
									[
										'type' => 'just_show',
										'title' => '團隊',
										'value' => 'title',
										'default' => ''
									],
									[
										'type' => 'radio_btn',
										'title' => '是否顯示',
										'value' => 'is_visible',
										'default' => ''
									]
								],
								'tabSet'=>
								[
									[
										'title' => '基本設定',
										'content' => 
										[
											[
												'type' => 'textInput',
												'title' => '團隊',
												'value' => 'title',
												'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
												'default' => ''
											],
											[
												'type' => 'textArea',
												'title' => '內容',
												'value' => 'intro',
												'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
												'default' => ''
											],
										],
									]
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