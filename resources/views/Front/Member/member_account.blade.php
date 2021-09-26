@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/member.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'member')
@section('bodyDataPage', 'member_account')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      @include('Front.Member.Component.center_name_block')
      <section class="mb_ct">
        <div class="common_wrap">
          @include('Front.Member.Component.center_sub_unit')
          <div class="account_ct waypoint">
            <div class="block">
              <div class="block_title">
                <div class="num"><span class="icon-lock"></span></div>
                <h1 class="block_name">{{$Setting['MemberAccount']->bak_title_1}}</h1>
              </div>
              <div class="account_block">
                <div class="form_line">
                  <div class="form_list">
                    <div class="form_title">{{$Setting['MemberAccount']->bak_title_2}}</div>
                    <div class="form_input">
                      <p>{{$memberdata['tel']}}</p>
                    </div>
                  </div>
                </div>
                <div class="form_line">
                  <div class="form_list">
                    <div class="form_title">{{$Setting['MemberAccount']->bak_title_3}}</div>
                    <div class="form_input">
                      <p>**********</p><a class="icon-pen icon lb_open" href="javascript:;" open-page="member_repassword" onclick="member.open_lb($(this))"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="account_del">
                <div class="account_top">
                  <div class="account_name">{{$Setting['MemberAccount']->bak_title_4}}</div>
                  <div class="account_p">
                    <p>{!!nl2br($Setting['MemberAccount']->bak_title_5)!!}</p>
                  </div>
                </div>
                <div class="account_btn">
                  <!-- 刪除申請成功 加delete--><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberAccount']->bak_title_6}}" open-page="member_accountdelete" onclick="member.open_lb($(this))">{{$Setting['MemberAccount']->bak_title_6}}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section changeformd class="lb_step" page="member_repassword">
        <div class="lb_step_wrap">
          <div class="mb_common step">
            <div class="lb_close btn_close"><span></span></div>
            <div class="mb_left">
              <div class="mb_left_wrap">
                <div class="mb_head">
                  <div class="mb_maintitle">{{$Setting['MemberAccount']->bak_title_7}}</div>
                  <div class="mb_p">{{$Setting['MemberAccount']->bak_title_8}}</div>
                </div>
                <div class="mb_process">
                  <div class="step_li active"><span>1</span>
                    <p>{{$Setting['MemberAccount']->bak_title_9}}</p>
                  </div>
                  <div class="step_li"><span>2</span>
                    <p>{{$Setting['MemberAccount']->bak_title_10}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb_right">
              <div old class="mb_right_wrap" data-page="1">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberAccount']->bak_title_11)!!}</div>
                </div>
                <div class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="password" type="password" placeholder="{{$Setting['MemberAccount']->bak_title_12}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_bt"><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberAccount']->bak_title_13}}" changeactold>{{$Setting['MemberAccount']->bak_title_13}}</a></div>
              </div>
              <div class="mb_right_wrap" data-page="2">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberAccount']->bak_title_14)!!}</div>
                </div>
                <div new class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="password" type="password" placeholder="{{$Setting['MemberAccount']->bak_title_15}}"/>
                      </div>
                    </div>
                  </div>
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="confirmpassword" type="password" placeholder="{{$Setting['MemberAccount']->bak_title_16}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_btn"><a class="czbtn" changeactnew href="javascript:;" data-ajax-route="ajax_member_Repassword3.html" data-ajax-container=".lightbox" data-ajax-callback="lightbox" data-ajax="data-ajax" data-text="{{$Setting['MemberAccount']->bak_title_17}}">{{$Setting['MemberAccount']->bak_title_17}}</a></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section suspendedform class="lb_step" page="member_accountdelete">
        <div class="lb_step_wrap">
          <div class="mb_common step">
            <div class="lb_close btn_close"><span></span></div>
            <div class="mb_left">
              <div class="mb_left_wrap">
                <div class="mb_head">
                  <div class="mb_maintitle">{{$Setting['MemberAccount']->bak_title_18}}</div>
                  <div class="mb_p">{{$Setting['MemberAccount']->bak_title_19}}</div>
                </div>
                <div class="mb_process">
                  <div class="step_li active"><span>1</span>
                    <p>{{$Setting['MemberAccount']->bak_title_20}}</p>
                  </div>
                  <div class="step_li"><span>2</span>
                    <p>{{$Setting['MemberAccount']->bak_title_21}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb_right">
              <div class="mb_right_wrap" data-page="1">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberAccount']->bak_title_22)!!}</div>
                </div>
                <div class="mb_block block">
                  <div class="form_line">
                    <div class="form_list">
                      <div class="form_input">
                        <input name="password" type="password" placeholder="{{$Setting['MemberAccount']->bak_title_23}}"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb_bt"><a class="czbtn" href="javascript:;" data-text="{{$Setting['MemberAccount']->bak_title_24}}" suspendedchkp>{{$Setting['MemberAccount']->bak_title_24}}</a></div>
              </div>
              <div class="mb_right_wrap" data-page="2">
                <div class="mb_head">
                  <div class="mb_title">{!!nl2br($Setting['MemberAccount']->bak_title_25)!!}</div>
                  <div class="mb_p">{!!nl2br($Setting['MemberAccount']->bak_title_26)!!}</div>
                </div>
                <div class="mb_btn"><a class="czbtn lb_close w185" href="javascript:;" data-text="{{$Setting['MemberAccount']->bak_title_27}}" suspendedact suspendedsuccess="停用成功，系統將自行登出">{{$Setting['MemberAccount']->bak_title_27}}</a></div>
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