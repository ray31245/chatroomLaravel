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
								'options' => $options['ArtCategory'],
								'value' => ( !empty($data['category']) )? $data['category'] : '',
								'tip' => '選擇此藝術所屬的分類。'
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title]',
								'title' => '藝術標題',
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
								'title' => '藝術列表圖',
								'image_array' =>
								[
									[
										'name' => $model.'[img]',
										'title' => '列表縮圖',
										'value' => ( !empty($data['img']) )? $data['img'] : '',
										'set_size' => 'yes',
										'width' => '660',
										'height' => '400',
									],
								],
								'tip' => '圖片建議尺寸 660 x 400 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}					

						@elseif($formKey == 'bForm')

							{{UnitMaker::textInput([
								'name' => $model.'[date]',
								'title' => '藝術時間',
								'tip' => '此處可任意填寫藝術時程。',
								'value' => ( !empty($data['date']) )? $data['date'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[location]',
								'title' => '藝術地點',
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
								'value' => ( !empty($associationData['son']['ArtBanner']) )? $associationData['son']['ArtBanner'] : [],
								'name' => 'ArtBanner',
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

							@include('Fantasy.cms.back_article',['Model'=> 'ArtArticle','ThreeModel'=>'ArtArticleThree'])

						@elseif($formKey == 'fForm')

							{{UnitMaker::select2Multi([
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
								'tip' => '創作資訊管理',
								'value' => ( !empty($associationData['son']['ArtStaff']) )? $associationData['son']['ArtStaff'] : [],
								'name' => 'ArtStaff',
								'tableSet' => 
								[
									[
										'type' => 'just_show',
										'title' => '創作',
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
												'title' => '創作',
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