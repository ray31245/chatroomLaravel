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
								'options' => $options['WorkCategory'],
								'model' => 'WorkCategory',
								'value' => ( !empty($data['category']) )? $data['category'] : '',
								'tip' => '選擇此創作所屬的分類。'
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title]',
								'title' => '創作名稱',
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
								'title' => '創作介紹',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['intro']) )? $data['intro'] : ''
							])}}
							{{UnitMaker::imageGroup([
								'title' => '創作列表圖',
								'image_array' =>
								[
									[
										'name' => $model.'[img]',
										'title' => '列表縮圖',
										'value' => ( !empty($data['img']) )? $data['img'] : '',
										'set_size' => 'no',
									],
								],
								// 'tip' => '圖片建議尺寸 270 x 285 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}

						@elseif($formKey == 'bForm')

							{{UnitMaker::textInput([
								'name' => $model.'[publisher]',
								'title' => '出版社名稱',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['publisher']) )? $data['publisher'] : ''
							])}}
							{{UnitMaker::datePicker([
								'name' => $model.'[publish_date]',
								'title' => '出版日期',
								'tip' => '請填寫此創作出版日期。',
								'value' => ( !empty($data['publish_date']) )? $data['publish_date'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[isbn]',
								'title' => 'ISBN',
								'tip' => '國際標準書號。',
								'value' => ( !empty($data['isbn']) )? $data['isbn'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[language]',
								'title' => '語言版本',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['language']) )? $data['language'] : ''
							])}}

						@elseif($formKey == 'cForm')
							
							{{UnitMaker::WNsonTable([
								'sort' => 'yes',
								'teach' => 'no',
								'MultiImgcreate' => 'yes', //使用多筆圖片						
								'imageColumn' => 'img',  //預設圖片欄位
								'hasContent' => 'yes',
								'tip' => '內頁Banner輪播圖管理',
								'value' => ( !empty($associationData['son']['WorkBanner']) )? $associationData['son']['WorkBanner'] : [],
								'name' => 'WorkBanner',
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
												'tip' => '圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
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

						@elseif($formKey == 'dForm')							

							@include('Fantasy.cms.back_article',['Model'=> 'WorkArticle','ThreeModel'=>'WorkArticleThree'])

						@elseif($formKey == 'eForm')

							{{UnitMaker::select2([
								'name' => $model.'[read_type]',
								'title' => '書皮樣式',
								'options' => config('options.ReadType'),
								'value' => ( !empty($data['read_type']) )? $data['read_type'] : '',
								'tip' => '請務必選擇試讀的書皮樣式。'
							])}}

							{{UnitMaker::colorPicker([
								'name' => $model.'[read_color]',
								'title' => '書皮顏色',
								'value' => ( !empty($data['read_color']) )? $data['read_color'] : '',
								'tip' => '選擇書皮顏色'
							])}}

							{{UnitMaker::imageGroup([
								'title' => '書皮封面圖',
								'image_array' =>
								[
									[
										'name' => $model.'[read_img]',
										'title' => '列表縮圖',
										'value' => ( !empty($data['read_img']) )? $data['read_img'] : '',
										'set_size' => 'no',
									],
								],
								'tip' => '圖片建議尺寸 : <br>直式 285 x 390 像素 <br>橫式 425 x 315 像素 <br> <br>圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}

						@elseif($formKey == 'fForm')
							
							{{UnitMaker::WNsonTable([
								'sort' => 'yes',
								'teach' => 'no',
								'MultiImgcreate' => 'yes', //使用多筆圖片						
								'imageColumn' => 'img',  //預設圖片欄位
								'hasContent' => 'yes',
								'tip' => '經典試讀內容',
								'value' => ( !empty($associationData['son']['WorkRead']) )? $associationData['son']['WorkRead'] : [],
								'name' => 'WorkRead',
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
												'tip' => '圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
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