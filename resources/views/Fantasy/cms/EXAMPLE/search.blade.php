@if(config('cms.New') == true)
  <form id="searchForm" class="" action="">
@endif

{{-- {{UnitMaker::textInput([
  'name' => 'title',
  'title' => '標題',
  'value' => '',
  'search' => true,
])}} --}}
{{-- {{UnitMaker::Select([
  'name' => 'gender',
  'title' => '性別',
  'value' => '',
  'options' => $options['FormGender'],
  'search' => true,
])}} --}}

@if(config('cms.New') == true)
  </form>
@endif