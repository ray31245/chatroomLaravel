@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
    <link rel="stylesheet" href="{{asset('dist/assets/css/service.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'service')
@section('bodyDataPage', 'service_form')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <div class="service_form_bn">
        <div class="common_wrap">
          <div class="bn_title">
            <div class="title_head">IUBER SERVICE</div>
            <p>After filling in the following repair form, someone will call you to understand the details of your product failure, and we will confirm with you the total cost of repair or replacement and the designated service address.</p>
          </div>
        </div>
      </div>
      <div class="service_form_ct">
        <div class="common_wrap">
          <div class="block">
            <div class="block_title">
              <div class="num" num="1"></div>
              <div class="block_name">Information</div>
            </div>
            <div class="form_ct">
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <input name="tel" type="text" {{ElementFunction::seeismodifi($Setting,'bak_title_1')}} placeholder="{{$Setting->bak_title_1}}" value="{{$memberdata?$memberdata->tel:''}}"/>
                  </div>
                </div>
                <div class="form_list must">
                  <div class="form_input">
                    <input name="name" type="text" placeholder="{{$Setting->bak_title_2}}" value="{{$memberdata?$memberdata->name:''}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list">
                  <div class="form_input">
                    <div class="formdd">
                      <div class="formdd_click {{!empty($Gender->keyBy('id')[$memberdata?$memberdata->gender:''])?'white':''}}">
                        <div class="formdd_title" data-reset="{{$Setting->bak_title_3}}">{{!empty($Gender->keyBy('id')[$memberdata?$memberdata->gender:''])?$Gender->keyBy('id')[$memberdata->gender]->title:$Setting->bak_title_3}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="formdd_select">
                        <div class="formdd_opt scroll scrollbar-inner theme-black">
                          <input type="hidden" name="gender" value="{{$memberdata?$memberdata->gender:''}}">
                          <ul>
                            @foreach ($Gender as $key => $value)
                              <li gender_id="{{$value->id}}">{{$value->title}}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form_list must add">
                  <div class="form_input">
                    <div class="formdd">
                      <div class="formdd_click {{!empty($Area->keyBy('id')[$memberdata?$memberdata->area:''])?'white':''}}">
                        <div class="formdd_title" data-reset="{{$Setting->bak_title_4}}">{{!empty($Area->keyBy('id')[$memberdata?$memberdata->area:''])?$Area->keyBy('id')[$memberdata?$memberdata->area:'']->title:$Setting->bak_title_4}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="formdd_select">
                        <div class="formdd_opt scroll scrollbar-inner theme-black">
                          <input type="hidden" name="area" value="{{$memberdata?$memberdata->area:''}}">
                          <ul>
                            @foreach ($Area as $key => $value)
                            <li area_id="{{$value->id}}">{{$value->title}}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                    <input name="address" type="text" placeholder="{{$Setting->bak_title_5}}" value="{{$memberdata?$memberdata->address:''}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <input name="birthday" type="text" placeholder="{{$Setting->bak_title_6}}" value="{{$memberdata?$memberdata->birthday:''}}"/>
                  </div>
                </div>
                <div class="form_list">
                  <div class="form_input">
                    <input name="email" type="text" placeholder="{{$Setting->bak_title_7}}" value="{{$memberdata?$memberdata->email:''}}"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="block">
            <div class="block_title">
              <div class="num" num="2"></div>
              <div class="block_name">What’s problem with product ?</div>
            </div>
            <div class="form_ct">
              <div class="form_line">
                <div class="type_select one_select brand">
                  <div class="type_list">
                    <div class="type_title">{{$Setting->bak_title_8}}</div><span></span>
                  </div>
                  <ul class="type_item">
                    <input type="hidden" name="brand" value="{{$barnd[0]->id}}">
                    @foreach ($barnd as $key => $value)
                    <li brand={{$value->id}} {{$loop->index==0?'class=select':''}}>
                      <div class="type_li">
                        <div class="type_pic"><img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/></div>
                        <div class="type_name">{{$value->title}}</div>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                  <div class="type_icon"><span></span></div>
                </div>
              </div>
              <div class="form_line">
                <div class="type_select more_select">
                  <div class="type_list">
                    <div class="type_title">{{$Setting->bak_title_9}}</div><span></span>
                  </div>
                  <ul class="type_item" modelslist>
                    <input type="hidden" name="model_id" value="">
                    @foreach ($model->where('parent_id',$barnd[0]->id) as $key => $value)
                    <li model_id={{$value->id}} {{$loop->index==0?'modelfirst':''}}>
                      <div class="type_li">
                        <div class="type_pic"><img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/></div>
                        <div class="type_name" modeltitle>{{$value->title}}</div>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                  <div class="type_icon"><span></span></div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <div class="formdd">
                      <div class="formdd_click">
                        <div class="formdd_title" data-reset="{{$Setting->bak_title_10}}">{{$Setting->bak_title_10}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="formdd_select">
                        <div class="formdd_opt scroll scrollbar-inner theme-black">
                          <ul>
                            <input type="hidden" name="subject_id">
                            @foreach ($Subject as $key => $value)
                            <li subject_id="{{$value->id}}">{{$value->title}}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <textarea name="message" placeholder="{{$Setting->bak_title_11}}"></textarea>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <div class="formdd">
                      <div class="formdd_click">
                        <div class="formdd_title" data-reset="{{$Setting->bak_title_12}}">{{$Setting->bak_title_12}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="formdd_select">
                        <div class="formdd_opt scroll scrollbar-inner theme-black">
                          <ul>
                            <input type="hidden" name="time">
                            @foreach ($Time as $key => $value)
                            <li time="{{$value->id}}">{{$value->title}}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list">
                  <div class="form_input">
                    <input name="warranty_card_number" type="text" placeholder="{{$Setting->bak_title_13}}"/><a class="coupon" href="javascript:;" data-ajax-route="Ajax/descriptionWarrantyNumberlightbox" data-ajax-container=".lightbox" data-ajax-callback="lightbox" data-ajax="data-ajax">?</a>
                  </div>
                </div>
                <div class="form_list must">
                  <div class="form_input">
                    <input name="captchacode" type="text" placeholder="{{$Setting->bak_title_14}}"/><img id="login_indexCapt" src="{{$Captcha['img']}}" data-key="{{$Captcha['key']}}" alt="" onclick="cgCapt('login_indexCapt')"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form_btn"><a class="czbtn clear" href="javascript:;" data-text="Clear">Clear</a><a submitBtn class="czbtn" href="javascript:;" data-text="Sumbit">Sumbit</a></div>
        </div>
      </div>
    </main>
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/service.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop