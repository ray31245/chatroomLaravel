@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif

{{UnitMaker::select2([
  'name' => 'art_id',
  'title' => '公共藝術',
  'options'=> $options['Art'],
  'value' => '',
  'search' => true,
])}}
{{UnitMaker::textInput([
  'name' => 'name',
  'title' => '留言者',
  'value' => '',
  'search' => true,
])}}

@if(config('cms.New') == true)
  </form>
@endif