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

                            @if( $data['id'] != 0)
                            <li class="inventory row_style">
                                <div class="title">
                                    <p class="subtitle">前台網址</p>
                                </div>
                                <input type="button" value="前往前台" style="display: block;margin: 0px 10px;width: 20%;text-align: center;font-size: 14px;cursor: pointer;background-color: #10cfbd;border: none;color: white;height: 42px;" onclick="window.open('{{BaseFunction::b_url('demo/'.$data['id'])}}');">
                            </li>
                            @endif

							@include('Fantasy.cms.back_article_v2',['Model'=> 'DemoArticle','ThreeModel'=>'DemoArticleThree'])			

						@endif

					</ul>
				</section>
			</div>
		</section>
	</article>
</div>


@if(config('cms.New') == true)
	</form>
@endif