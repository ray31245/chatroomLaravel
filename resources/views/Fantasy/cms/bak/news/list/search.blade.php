@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif

{{UnitMaker::select2([
  'name' => 'category',
  'title' => '所屬分類',
  'options'=> $options['NewsCategory'],
  'value' => '',
  'search' => true,
])}}
{{UnitMaker::textInput([
  'name' => 'title',
  'title' => '新聞標題',
  'value' => '',
  'search' => true,
])}}



{{-- {{UnitMaker::dateRange([
  'name' => 'news_date',
  'title' => '新聞日期',
  'value' => '',
  'value2' => '',
  'search' => true,
])}} --}}

@if(config('cms.New') == true)
  </form>
@endif