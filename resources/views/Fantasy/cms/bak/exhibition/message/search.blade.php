@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif

{{UnitMaker::select2([
  'name' => 'exhibition_id',
  'title' => '展覽',
  'options'=> $options['Exhibition'],
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