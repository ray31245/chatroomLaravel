@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/member.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'member')
@section('bodyDataPage', 'member_profile')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      @include('Front.Member.Component.center_name_block')
      <section class="mb_ct">
        <div class="common_wrap">
          @include('Front.Member.Component.center_sub_unit')
          <div class="profile_ct waypoint">
            <div class="block">
              <div class="block_title">
                <div class="num"><span class="icon-member"></span></div>
                <h1 class="block_name">{{$Setting['MemberProfile']->bak_title_1}}</h1>
              </div>
              <div profileform class="form_ct">
                <div class="form_line">
                  <div class="form_list">
                    <div class="form_title">{{$Setting['MemberProfile']->bak_title_2}}</div>
                    <div class="form_input">
                      <p avatartxt class="pic_name">{{$Setting['MemberProfile']->bak_title_3}}</p><span class="icon icon-camera"></span>
                      <input id="upload" name="avatar" type="file" accept="image/gif, image/jpeg, image/png"/>
                    </div>
                  </div>
                  <div class="form_list">
                    <div class="form_title">{{$Setting['MemberProfile']->bak_title_4}}</div>
                    <div class="form_input">
                      <input name="name" value="{{$memberdata['name']}}" type="text" placeholder="{{$Setting['MemberProfile']->bak_title_5}}"/>
                    </div>
                  </div>
                </div>
                <div class="form_line">
                  <div class="form_list">
                    <div class="form_title">{{$Setting['MemberProfile']->bak_title_6}}</div>
                    <div class="form_input">
                      <div class="formdd">
                        <div class="formdd_click{{!empty($Gender[$memberdata['gender']])?' white':''}}">
                          <div class="formdd_title" data-reset="{{$Setting['MemberProfile']->bak_title_6}}">{{!empty($Gender[$memberdata['gender']])?$Gender[$memberdata['gender']]['title']:'Gender'}}</div>
                          <div class="icon-arrow_right"></div>
                        </div>
                        <div class="formdd_select">
                          <div class="formdd_opt scroll scrollbar-inner theme-black">
                            <input type="hidden" name="gender" value="{{$memberdata['gender']}}">
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
                  <div class="form_list add">
                    <div class="form_input">
                      <div class="formdd">
                        <div class="formdd_click{{!empty($Area[$memberdata['area']])?' white':''}}">
                          <div class="formdd_title" data-reset="Taiwan">{{!empty($Area[$memberdata['area']])?$Area[$memberdata['area']]['title']:'Taiwan'}}</div>
                          <div class="icon-arrow_right"></div>
                        </div>
                        <div class="formdd_select">
                          <div class="formdd_opt scroll scrollbar-inner theme-black">
                            <input type="hidden" name="area" value="{{$memberdata['area']}}">
                            <ul>
                              @foreach ($Area as $key => $value)
                                <li area_id="{{$value->id}}">{{$value->title}}</li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>
                      <input type="text" name="address" placeholder="{{$Setting['MemberProfile']->bak_title_7}}" value="{{$memberdata['address']}}"/>
                    </div>
                  </div>
                </div>
                <div class="form_line">
                  <div class="form_list">
                    <div class="form_title">{{$Setting['MemberProfile']->bak_title_8}}</div>
                    <div class="form_input">
                      <input name="birthday" type="text" placeholder="{{$Setting['MemberProfile']->bak_title_9}}" value="{{$memberdata['birthday']}}"/>
                    </div>
                  </div>
                  <div class="form_list">
                    <div class="form_title">{{$Setting['MemberProfile']->bak_title_10}}</div>
                    <div class="form_input">
                      <input name="email" type="text" placeholder="{{$Setting['MemberProfile']->bak_title_11}}" value="{{$memberdata['email']}}"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form_btn"><a class="czbtn clear" href="javascript:;" profileact data-text="{{$Setting['MemberProfile']->bak_title_12}}">{{$Setting['MemberProfile']->bak_title_12}}</a></div>
            </div>
          </div>
        </div>
      </section>
    </main>
    {{-- <!-- 頁尾--> --}}
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/member.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop