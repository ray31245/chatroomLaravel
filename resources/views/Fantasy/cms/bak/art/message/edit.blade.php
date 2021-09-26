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

							{{UnitMaker::select([
								'name' => $model.'[state]',
								'title' => '狀態',
								'options' => Config::get('options.MessageState'),
								'value' => ( !empty($data['state']) )? $data['state'] : ''
							])}}
							{{UnitMaker::textInput([
								'name' => $model.'[name]',
								'title' => '留言者',
								'value' => ( !empty($data['name']) )? $data['name'] : '',
								'disabled' => 'disabled',
								'tip' => '',
							])}}
							{{UnitMaker::textArea([
								'name' => $model.'[message]',
								'title' => '留言內容',
								'value' => ( !empty($data['message']) )? $data['message'] : '',
								'disabled' => 'disabled',
								'tip' => '',
							])}}	
							{{UnitMaker::textArea([
								'name' => $model.'[reply]',
								'title' => '幾米回覆',
								'value' => ( !empty($data['reply']) )? $data['reply'] : '',
							])}}

						@endif

					</ul>
				</section>
			</div>
		</section>
	</article>
</div>

<script type="text/javascript">
	$(function () {
		$('#aForm .tips:lt(2)').remove();
	});
</script>

@if(config('cms.New') == true)
	</form>
@endif