@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/member.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'member')
@section('bodyDataPage', 'member_signup')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      <section class="mb_common js_fixed waypoint">
        <div class="mb_left">
          <div class="mb_left_wrap">
            <div class="mb_head">
              <div class="mb_maintitle">{!!nl2br($Setting['MemberSigup']->bak_title_1)!!}</div>
              <div class="mb_p">{{$Setting['MemberSigup']->bak_title_2}}</div>
            </div>
            <div class="mb_bt">
              <p>{{$Setting['MemberSigup']->bak_title_3}}</p>
              <div class="mb_btn"><a class="czbtn" href="{{basefunction::b_url('Member/login')}}" data-text="{{$Setting['MemberSigup']->bak_title_4}}">{{$Setting['MemberSigup']->bak_title_4}}</a></div>
            </div>
          </div>
        </div>
        <div class="mb_right">
          <div class="mb_right_wrap">
            <div class="mb_head">
              <h1 class="mb_title">{!!nl2br($Setting['MemberSigup']->bak_title_5)!!}</h1>
            </div>
            <div class="mb_block block">
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <input name="tel" type="text" placeholder="{{$Setting['MemberSigup']->bak_title_6}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <input name="name" type="text" placeholder="{{$Setting['MemberSigup']->bak_title_7}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list">
                  <div class="form_input">
                    <div class="formdd">
                      <div class="formdd_click">
                        <div class="formdd_title" data-reset="{{$Setting['MemberSigup']->bak_title_8}}">{{$Setting['MemberSigup']->bak_title_8}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="formdd_select">
                        <div class="formdd_opt scroll scrollbar-inner theme-black">
                          <input type="hidden" name="gender">
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
              </div>
              <div class="form_line">
                <div class="form_list must add">
                  <div class="form_input">
                    <div class="formdd">
                      <div class="formdd_click">
                        <div class="formdd_title" data-reset="{{$Setting['MemberSigup']->bak_title_9}}">{{$Setting['MemberSigup']->bak_title_9}}</div>
                        <div class="icon-arrow_right"></div>
                      </div>
                      <div class="formdd_select">
                        <div class="formdd_opt scroll scrollbar-inner theme-black">
                          <input type="hidden" name="area">
                          <ul>
                            @foreach ($Area as $key => $value)
                            <li area_id="{{$value->id}}">{{$value->title}}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                    <input type="text" name="address" placeholder="{{$Setting['MemberSigup']->bak_title_10}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <input type="text" name="birthday" placeholder="{{$Setting['MemberSigup']->bak_title_11}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list">
                  <div class="form_input">
                    <input type="text" name="email" placeholder="{{$Setting['MemberSigup']->bak_title_12}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list must">
                  <div class="form_input">
                    <input name="captchacode" type="text" placeholder="{{$Setting['MemberSigup']->bak_title_13}}"/><img id="login_indexCapt" src="{{$Captcha['img']}}" data-key="{{$Captcha['key']}}" alt="" onclick="cgCapt('login_indexCapt')"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb_btn">
              <div agreed="請先勾選同意隱私權政策" class="agree_btn"><span class="icon-checked"></span>
                <p>{{$Setting['MemberSigup']->bak_title_15}}<a href="{{basefunction::b_url('Privacy')}}" target="_blank" class="line">{{$Setting['MemberSigup']->bak_title_16}}</a></p>
              </div><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberSigup']->bak_title_14}}" open-page="member_signup" signups1>{{$Setting['MemberSigup']->bak_title_14}}</a>
            </div>
          </div>
        </div>
      </section>
      <section lbContain class="lb_step" page="member_signup">
        <div class="lb_step_wrap">
          <div class="mb_common step">
            <div class="lb_close btn_close"><span></span></div>
            <div class="mb_left">
              <div class="mb_left_wrap">
                <div class="mb_head">
                  <div class="mb_maintitle">{!!nl2br($Setting['MemberSigup']->bak_title_17)!!}</div>
                  <div class="mb_p">{{$Setting['MemberSigup']->bak_title_18}}</div>
                </div>
                <div class="mb_process">
                  <div class="step_li"><span>1</span>
                    <p>{{$Setting['MemberSigup']->bak_title_19}}</p>
                  </div>
                  <div class="step_li active"><span>2</span>
                    <p>{{$Setting['MemberSigup']->bak_title_20}}</p>
                  </div>
                  <div class="step_li"><span>3</span>
                    <p>{{$Setting['MemberSigup']->bak_title_21}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb_right">
              <div class="mb_right_wrap" data-page="1">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberSigup']->bak_title_22)!!}</div>
                </div>
                <div class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input type="text" VerificationCode placeholder="{{$Setting['MemberSigup']->bak_title_23}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_bt">
                  <div class="reverify_btn"><span class="icon-return"></span>
                    <div class="reverify_word">
                      <p>{{$Setting['MemberSigup']->bak_title_24}}<span class="countdown" data-seconds="10">10 sec</span></p>
                      <p>{{$Setting['MemberSigup']->bak_title_26}}<a href="javascript:;" resendVerificationCode class='send_again'>{{$Setting['MemberSigup']->bak_title_27}}</a></p>
                    </div>
                  </div>
                  <div class="mb_btn"><a class="czbtn lb_close" href="javascript:;" data-text="{{$Setting['MemberSigup']->bak_title_28}}">{{$Setting['MemberSigup']->bak_title_28}}</a><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberSigup']->bak_title_29}}" step2next>{{$Setting['MemberSigup']->bak_title_29}}</a></div>
                </div>
              </div>
              <div class="mb_right_wrap" data-page="2">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberSigup']->bak_title_30)!!}</div>
                </div>
                <div class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="password" type="password" placeholder="{{$Setting['MemberSigup']->bak_title_31}}"/>
                      </div>
                    </div>
                  </div>
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="confirmpassword" type="password" placeholder="{{$Setting['MemberSigup']->bak_title_32}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_btn"><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberSigup']->bak_title_33}}" step3finish>{{$Setting['MemberSigup']->bak_title_33}}</a></div>
              </div>
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