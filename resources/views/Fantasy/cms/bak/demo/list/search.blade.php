@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif


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