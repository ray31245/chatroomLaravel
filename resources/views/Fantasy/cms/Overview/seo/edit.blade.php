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

							{{UnitMaker::textInput([
								'name' => $model.'[Identify_title]',
								'title' => '單元名稱',
								'disabled' => 'disabled',
								'value' => ( !empty($data['Identify_title']) )? $data['Identify_title'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[web_title]',
								'title' => '網頁標題',
								'tip' => '上限100字元，單行輸入，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['web_title']) )? $data['web_title'] : ''
							])}}

							{{UnitMaker::textArea([
								'name' => $model.'[meta_keyword]',
								'title' => 'Meta關鍵字',
								'tip'=>'上限300字元，關鍵字請用逗號(,)區隔，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['meta_keyword']) )? $data['meta_keyword'] : ''
							])}}

							{{UnitMaker::textArea([
								'name' => $model.'[meta_description]',
								'title' => 'Meta描述',
								'tip'=>'上限300字元，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['meta_description']) )? $data['meta_description'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[og_description]',
								'title' => '分享顯示文字',
								'tip'=> '上限300字元，內容不支援HTML及CSS、JQ、JS等語法。',
								'value' => ( !empty($data['og_description']) )? $data['og_description'] : ''
							])}}

							@if ($data['key']=='all')
							{{UnitMaker::textInput([
								'name' => $model.'[ga_code]',
								'title' => '網頁GA碼',
								'tip'=>'輸入編號即可，不需要整段程式碼。',
								'value' => ( !empty($data['ga_code']) )? $data['ga_code'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[gtm_code]',
								'title' => '網頁GTM碼',
								'tip'=>'輸入編號即可，不需要整段程式碼。',
								'value' => ( !empty($data['gtm_code']) )? $data['gtm_code'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[gtag]',
								'title' => '全域網站代碼',
								'tip'=>'輸入編號即可，不需要整段程式碼。',
								'value' => ( !empty($data['gtag']) )? $data['gtag'] : ''
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[schema_code]',
								'title' => '結構化標籤',
								'value' => ( !empty($data['schema_code']) )? $data['schema_code'] : '',
								'tip'  => '可輸入多行文字,使用方式可參考<a target="_blank" href="https://schema.org/">https://schema.org/</a>
								</br><span style="cursor:pointer; color:red;" id="set_default">點擊自動帶入預設範例</span>',
								// 'tip'  => '可輸入多行文字,使用方式可參考<br>換行',
							])}}
							@else
							{{-- 神奇的一個網站多的GA、GTM --}}
							{{UnitMaker::textInput([
								'name' => $model.'[ga_code]',
								'title' => '網頁GA碼',
								'tip'=>'輸入編號即可，不需要整段程式碼。',
								'value' => ( !empty($data['ga_code']) )? $data['ga_code'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[gtm_code]',
								'title' => '網頁GTM碼',
								'tip'=>'輸入編號即可，不需要整段程式碼。',
								'value' => ( !empty($data['gtm_code']) )? $data['gtm_code'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[gtag]',
								'title' => '全域網站代碼',
								'tip'=>'輸入編號即可，不需要整段程式碼。',
								'value' => ( !empty($data['gtag']) )? $data['gtag'] : ''
							])}}
							{{-- 神奇的一個網站多的GA、GTM --}}
							{{UnitMaker::textArea([
								'name' => $model.'[schema_code]',
								'title' => '結構化標籤',
								'value' => ( !empty($data['schema_code']) )? $data['schema_code'] : '',
								'tip'  => '可輸入多行文字,使用方式可參考<a target="_blank" href="https://schema.org/">https://schema.org/</a>',
								// 'tip'  => '可輸入多行文字,使用方式可參考<br>換行',
							])}}
							@endif
							{{UnitMaker::imageGroup([
								'title' => '分享縮圖管理',
								'image_array' =>
								[
									[
										'name' => $model.'[og_image]',
										'title' => '分享縮圖',
										'value' => ( !empty($data['og_image']) )? $data['og_image'] : '',
										'set_size' => 'yes',
										'width' => '1200',
										'height' => '630',
									]
								],
								'tip' => '圖片建議尺寸：1200x630。'
							])}}

						@endif

					</ul>
				</section>
			</div>
		</section>
	</article>
</div>
<script>
	$("#set_default").off('click').on('click',function(){
// alert('123');
var default_schema_1_tag_1 = 
'<script type="application/ld+json">';
var json1 = {
  "@context": "http://www.schema.org",
  "@type": "ProfessionalService",
  "name": "網站名子",
  "email": "mailto:email",
  "url": "本站網址",
  "image": "favicon logo路徑",
  "priceRange":"商品價格區間",
  "telephone": "電話",
  "logo": "logo路徑",
  "address": {
	"@type": "PostalAddress",
	"streetAddress": "地址",
	"addressLocality": "區",
	"addressRegion": "成市",
	"postalCode": "郵遞區號",
	"addressCountry": "中華民國 (台灣)"
  },
  "geo": {
	"@type": "GeoCoordinates",
	"latitude": "22.619435",
	"longitude": "120.296034"
  },
  "hasMap": "https://www.google.com.tw/maps/place/據點地圖",
  "openingHours": [
	"Mo-Th 11:00-22:00",
	"Fr 11:00-22:30",
	"Sa 10:30-22:30",
	"Su 10:30-22:00"
  ],
  "contactPoint": {
	"@type": "ContactPoint",
	"contactType": "customer service",
	"telephone": "+886-00-12345678"
  },
  "sameAs": [ "https://www.facebook.com/xxxxxxxx" ]
};


var default_schema_1_tag_2 = '<\/script>';
var default_schema_2_tag_1 = '<script type="application\/ld+json">';
var  json2 = {
  "@context": "http://www.schema.org",
  "@type": "BreadcrumbList",
  "itemListElement":
  [
	{
	  "@type": "ListItem",
	  "position": 1,
	  "item":
	  {
		"@id": "https://example.com/dresses",
		"name": "Dresses"
	  }
	},
	{
	  "@type": "ListItem",
	  "position": 2,
	  "item":
	  {
		"@id": "https://example.com/dresses/real",
		"name": "Real Dresses"
	  }
	}
  ]
};
var default_schema_2_tag_2 = '<\/script>';
var default_schema = default_schema_1_tag_1+JSON.stringify(json1)+default_schema_1_tag_2;
var tips = confirm("點選確定將會洗掉當前內容，帶入預設值");
if (tips) {
	$('[name="Seo[schema_code]"]').val(default_schema);
}
})
</script>


@if(config('cms.New') == true)
	</form>
@endif