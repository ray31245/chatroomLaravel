@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/member.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'member')
@section('bodyDataPage', 'member')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      <section class="mb_common waypoint">
        <div class="mb_left">
          <div class="mb_left_wrap">
            <div class="mb_head">
              <div class="mb_maintitle">{{$Setting['MemberLogin']->bak_title_1}}</div>
              <div class="mb_p">{{$Setting['MemberLogin']->bak_title_2}}</div>
            </div>
            <div class="mb_bt">
              <p>{{$Setting['MemberLogin']->bak_title_3}}</p>
              <div class="mb_btn"><a class="czbtn" href="{{basefunction::b_url('Member/SignUp')}}" data-text="{{$Setting['MemberLogin']->bak_title_4}}">{{$Setting['MemberLogin']->bak_title_4}}</a></div>
            </div>
          </div>
        </div>
        <div class="mb_right">
          <div class="mb_right_wrap">
            <div class="mb_head">
              <h1 class="mb_title">{!!nl2br($Setting['MemberLogin']->bak_title_5)!!}</h1>
            </div>
            <div loginform class="mb_block block">
              <div class="form_line">
                <div class="form_list">
                  <div class="form_input">
                    <input name="tel" type="text" placeholder="{{$Setting['MemberLogin']->bak_title_6}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list">
                  <div class="form_input">
                    <input name="password" type="password" placeholder="{{$Setting['MemberLogin']->bak_title_7}}"/>
                  </div>
                </div>
              </div>
              <div class="form_line">
                <div class="form_list">
                  <div class="form_input">
                    <input name="captchacode" type="text" placeholder="{{$Setting['MemberLogin']->bak_title_8}}"/><img id="login_indexCapt" src="{{$Captcha['img']}}" data-key="{{$Captcha['key']}}" alt="" onclick="cgCapt('login_indexCapt')"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb_btn"><a class="forget_btn" href="javascript:;" open-page="member_forgetpassword" onclick="member.open_lb($(this))"><span>?</span>
                <p>{{$Setting['MemberLogin']->bak_title_10}}</p></a><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberLogin']->bak_title_9}}" loginact>{{$Setting['MemberLogin']->bak_title_9}}</a></div>
          </div>
        </div>
      </section>
      <section lbContain class="lb_step" page="member_forgetpassword">
        <div class="lb_step_wrap">
          <div class="mb_common step">
            <div class="lb_close btn_close"><span></span></div>
            <div class="mb_left">
              <div class="mb_left_wrap">
                <div class="mb_head">
                  <div class="mb_maintitle">{!!nl2br($Setting['MemberLogin']->bak_title_11)!!}</div>
                  <div class="mb_p">{{$Setting['MemberLogin']->bak_title_12}}</div>
                </div>
                <div class="mb_process">
                  <div class="step_li active"><span>1</span>
                    <p>{{$Setting['MemberLogin']->bak_title_13}}</p>
                  </div>
                  <div class="step_li"><span>2</span>
                    <p>{{$Setting['MemberLogin']->bak_title_14}}</p>
                  </div>
                  <div class="step_li"><span>3</span>
                    <p>{{$Setting['MemberLogin']->bak_title_15}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb_right">
              <div forgetstep1 class="mb_right_wrap" data-page="1">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberLogin']->bak_title_16)!!}</div>
                </div>
                <div class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="tel" type="text" placeholder="{{$Setting['MemberLogin']->bak_title_17}}"/>
                      </div>
                    </div>
                  </div>
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="captchacode" type="text" placeholder="{{$Setting['MemberLogin']->bak_title_18}}"/><img id="forgetpassword" src="{{$Captcha['img']}}" data-key="{{$Captcha['key']}}" alt="" onclick="cgCapt('forgetpassword')"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_bt"><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberLogin']->bak_title_19}}" forgetstep1next>{{$Setting['MemberLogin']->bak_title_19}}</a></div>
              </div>
              <div class="mb_right_wrap" data-page="2">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberLogin']->bak_title_20)!!}</div>
                </div>
                <div class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input type="text" VerificationCode placeholder="{{$Setting['MemberLogin']->bak_title_21}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_bt">
                  <div class="reverify_btn"><span class="icon-return"></span>
                    <div class="reverify_word">
                      <p>{{$Setting['MemberLogin']->bak_title_22}}<span class="countdown" data-seconds="10">300</span></p>
                      <p>{{$Setting['MemberLogin']->bak_title_24}}<a resendVerificationCode href="javascript:;" class='send_again'>{{$Setting['MemberLogin']->bak_title_25}}</a></p>
                    </div>
                  </div>
                  <div class="mb_btn"><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberLogin']->bak_title_26}}" onclick="member.lb_step($(this),'back')">{{$Setting['MemberLogin']->bak_title_26}}</a><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberLogin']->bak_title_27}}" forgetstep2next>{{$Setting['MemberLogin']->bak_title_27}}</a></div>
                </div>
              </div>
              <div class="mb_right_wrap" data-page="3">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberLogin']->bak_title_28)!!}</div>
                </div>
                <div class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="password" type="password" placeholder="{{$Setting['MemberLogin']->bak_title_29}}"/>
                      </div>
                    </div>
                  </div>
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="confirmpassword" type="password" placeholder="{{$Setting['MemberLogin']->bak_title_30}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_btn"><a class="czbtn" href="javascript:;" forgetfinish data-text="{{$Setting['MemberLogin']->bak_title_31}}">{{$Setting['MemberLogin']->bak_title_31}}</a></div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    {{-- <!-- 頁尾--> --}}
    @include('Front.layout.footer')
    @section('script')
    {{-- <!-- 頁尾--> --}}
    <script src="/assets/js/plus/member.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop