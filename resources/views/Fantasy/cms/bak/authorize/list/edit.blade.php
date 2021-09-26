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
								'name' => $model.'[category2_id]',
								'title' => '所屬分類',
								'options' => $options['AuthorizeCategory2'],
								'value' => ( !empty($data['category2_id']) )? $data['category2_id'] : '',
								'tip' => '選擇此授權所屬的分類。'
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title]',
								'title' => '授權標題',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['title']) )? $data['title'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[url_title]',
								'title' => '網址關鍵字',
								'tip' => '此分類網址名稱，可使用中文，不可留白有空格、不可重複、不可使用特殊符號如「;　/　?　:　@　=　&　<　>　"　#　%　{　}　|　\　^　~　[　]　`　」',
								'value' => ( !empty($data['url_title']) )? $data['url_title'] : ''
							])}}
							{{UnitMaker::select2([
								'name' => $model.'[list_type]',
								'title' => '列表樣式',
								'options' => config('options.AuthorizeType'),
								'value' => ( !empty($data['list_type']) )? $data['list_type'] : 1,
								'tip' => '選擇此授權於列表之樣式。'
							])}}
							{{UnitMaker::imageGroup([
								'title' => '授權列表圖',
								'image_array' =>
								[
									[
										'name' => $model.'[list_img]',
										'title' => '列表縮圖',
										'value' => ( !empty($data['list_img']) )? $data['list_img'] : '',
										'set_size' => 'yes',
										'width' => '660',
										'height' => '400',
									],
								],
								'tip' => '圖片建議尺寸 660 x 400 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}					

						@elseif($formKey == 'bForm')

							{{UnitMaker::imageGroup([
								'title' => 'Logo圖',
								'image_array' =>
								[
									[
										'name' => $model.'[logo]',
										'title' => 'Logo圖',
										'value' => ( !empty($data['logo']) )? $data['logo'] : '',
										'set_size' => 'yes',
										'width' => '660',
										'height' => '400',
									],
								],
								'tip' => '圖片建議尺寸 660 x 400 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}	

							{{UnitMaker::datePicker([
								'name' => $model.'[date]',
								'title' => '合作時間',
								'tip' => '前台資料排序以此欄位為主，日期相同時以排序為輔。',
								'value' => ( !empty($data['date']) )? $data['date'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[location]',
								'title' => '授權地區',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['location']) )? $data['location'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[counterpart]',
								'title' => '合作對象',
								'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['counterpart']) )? $data['counterpart'] : ''
							])}}

							{{UnitMaker::textArea([
								'name' => $model.'[counterpart_url]',
								'title' => '合作對象連結',
								'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。',
								'value' => ( !empty($data['counterpart_url']) )? $data['counterpart_url'] : ''
							])}}

						@elseif($formKey == 'cForm')
							
							{{UnitMaker::WNsonTable([
								'sort' => 'yes',
								'teach' => 'no',
								'MultiImgcreate' => 'yes', //使用多筆圖片						
								'imageColumn' => 'img',  //預設圖片欄位
								'hasContent' => 'yes',
								'tip' => '內頁Banner輪播圖管理',
								'value' => ( !empty($associationData['son']['AuthorizeBanner']) )? $associationData['son']['AuthorizeBanner'] : [],
								'name' => 'AuthorizeBanner',
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
												'tip' => '圖片建議尺寸 800 x 445 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
												'image_array' => 
												[
													[
														'title' => '圖片',
														'value' => 'img',
														'set_size' => 'yes',
														'width' => '800',
														'height' => '445',
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
											[
												'type' => 'textInput',
												'title' => '影片代碼',
												'value' => 'video',
												'tip' => '在欄位內輸入Youtube影片網址V後面的英文數字。<br>例：https://www.youtube.com/watch?v=abcdef，請輸入abcdef。',
												'default' => ''
											]
										],
									]
								]
							])}}

						
						@elseif($formKey == 'eForm')

							@include('Fantasy.cms.back_article',['Model'=> 'AuthorizeArticle','ThreeModel'=>'AuthorizeArticleThree'])

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