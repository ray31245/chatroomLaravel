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
								'options' => $options['NewsCategory'],
								'model' => 'NewsCategory',
								'value' => ( !empty($data['category']) )? $data['category'] : '',
								'tip' => '選擇此訊息所屬的分類。'
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[title]',
								'title' => '新聞標題',
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
								'title' => '訊息列表圖',
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
								'tip' => '圖片建議尺寸 270 x 285 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
							])}}

						@elseif($formKey == 'bForm')

							{{UnitMaker::datePicker([
								'name' => $model.'[news_date]',
								'title' => '訊息日期',
								'tip' => '前台資料排序以此欄位為主，日期相同時以排序為輔，此欄位顯示於列表日期區塊。',
								'value' => ( !empty($data['news_date']) )? $data['news_date'] : ''
							])}}
							{{UnitMaker::datePicker([
								'name' => $model.'[up_date]',
								'title' => '上架日期',
								'tip' => '請填寫此訊息上架時間。',
								'value' => ( !empty($data['up_date']) )? $data['up_date'] : ''
							])}}
							{{UnitMaker::datePicker([
								'name' => $model.'[down_date]',
								'title' => '下架日期',
								'tip' => '請填寫此訊息下架時間',
								'value' => ( !empty($data['down_date']) )? $data['down_date'] : ''
							])}}
						@elseif($formKey == 'c1Form')

							{{UnitMaker::WNsonTable([
								'sort' => 'yes',
								'teach' => 'no',
								'hasContent' => 'yes',
								'tip' => '內文Banner輪播圖管理 <br> 當輸入影片代碼時將自動使用影片模式<br>若有上傳圖片將設定為影片預覽圖，若無上傳圖片則使用Youtube預設預覽圖',
								'value' => ( !empty($associationData['son']['NewsBanner']) )? $associationData['son']['NewsBanner'] : [],
								'name' => 'NewsBanner',
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
												'tip' => '圖片建議尺寸 1040 x 580 像素，圖片解析度限制:72DPI，檔案格式限定:JPG、PNG、GIF。',
												'image_array' => 
												[
													[
														'title' => '圖片',
														'value' => 'img',
														'set_size' => 'yes',
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

						@elseif($formKey == 'c2Form')

							@include('Fantasy.cms.back_article_v2',['Model'=> 'NewsArticle','ThreeModel'=>'NewsArticleThree'])

						@elseif($formKey == 'dForm')

							{{UnitMaker::WNsonTable([
								'sort' => 'yes',
								'teach' => 'no',
								'hasContent' => 'yes',
								'tip' => '相關檔案/連結管理。',
								'value' => ( !empty($associationData['son']['NewsFile']) )? $associationData['son']['NewsFile'] : [],
								'name' => 'NewsFile',
								'tableSet' => 
								[
									[
										'type' => 'just_show',
										'title' => '顯示名稱',
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
												'title' => '顯示名稱',
												'value' => 'title',
												'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
												'default' => ''
											],
											[
												'type' => 'select',
												'title' => '連結樣式',
												'value' => 'type',
												'default' => '',
												'tip' => '選擇此項目為檔案下載/網址連結。',
												'options' => config('options.DownloadType')
											],
											[
												'type' => 'filePicker',
												'title' => '相關檔案',
												'value' => 'file',
												'tip' => '選擇供下載之檔案。',
												'default' => ''
											],
											[
												'type' => 'textInput',
												'title' => '連結網址',
												'value' => 'url',
												'tip' => '輸入欲連結網址。',
												'default' => ''
                                            ],
                                            [
												'type' => 'select2Multi',
												'title' => '連結樣式test',
												'value' => 'test',
												'default' => '',
												'tip' => '選擇此項目為檔案下載/網址連結。',
												'options' => config('options.DownloadType')
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