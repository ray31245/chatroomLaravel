@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif

{{UnitMaker::select2([
  'name' => 'category',
  'title' => '所屬分類',
  'options'=> $options['ArtCategory'],
  'value' => '',
  'search' => true,
])}}
{{UnitMaker::textInput([
  'name' => 'title',
  'title' => '藝術名稱',
  'value' => '',
  'search' => true,
])}}


@if(config('cms.New') == true)
  </form>
@endif