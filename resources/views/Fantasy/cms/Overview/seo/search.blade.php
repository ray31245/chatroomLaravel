@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif

{{UnitMaker::textInput([
  'name' => 'title',
  'title' => '單元名稱',
  'value' => '',
  'search' => true,
])}}

@if(config('cms.New') == true)
  </form>
@endif