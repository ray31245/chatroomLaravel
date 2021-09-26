@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif

{{UnitMaker::select2([
  'name' => 'entertainment_id',
  'title' => '娛樂',
  'options'=> $options['Entertainment'],
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