@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/member.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'member')
@section('bodyDataPage', 'member_home')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      @include('Front.Member.Component.center_name_block')
      <section class="mb_overview_ct">
        <div class="common_wrap">
          <ul class="overview_ul">
            <li class="waypoint">
              <div class="li_top">
                <div class="li_hd">
                  <div class="hd_icon"><span class="icon-member"></span></div>
                  <div class="hd_title">{{$Setting['MemberCenter']->bak_title_5}}</div>
                </div>
                <div class="li_ct">
                  <p>{!!nl2br($Setting['MemberCenter']->bak_intro_1)!!}</p>
                </div>
              </div>
              <div class="li_bt"><a class="czbtn" href="{{basefunction::b_url('Member/Center/Profile')}}" data-text="{{$Setting['MemberCenter']->bak_title_7}}">{{$Setting['MemberCenter']->bak_title_7}}</a></div>
            </li>
            <li class="waypoint">
              <div class="li_top">
                <div class="li_hd">
                  <div class="hd_icon"><span class="icon-lock"></span></div>
                  <div class="hd_title">{{$Setting['MemberCenter']->bak_title_8}}</div>
                </div>
                <div class="li_ct">
                  <p>{!!nl2br($Setting['MemberCenter']->bak_intro_2)!!}</p>
                </div>
              </div>
              <div class="li_bt"><a class="czbtn" href="{{basefunction::b_url('Member/Center/Account')}}" data-text="{{$Setting['MemberCenter']->bak_title_10}}">{{$Setting['MemberCenter']->bak_title_10}}</a></div>
            </li>
            <li class="waypoint">
              <div class="li_top">
                <div class="li_hd">
                  <div class="hd_icon"><span class="icon-repair"></span></div>
                  <div class="hd_title">{{$Setting['MemberCenter']->bak_title_11}}</div>
                </div>
                <div class="li_ct">
                  <div class="input_p">{{nl2br($Setting['MemberCenter']->bak_intro_3)}}</div>
                  <div class="input">
                    <input type="text" name="case_sn" placeholder="{{$Setting['MemberCenter']->bak_title_13}}"/><a casesearch inputempyt='請輸入維護序號' class="icon-search" href="javascript:;"></a>
                  </div>
                </div>
              </div>
              <div class="li_bt"><a class="czbtn" href="{{basefunction::b_url('Member/Center/Maintenances')}}" data-text="{{$Setting['MemberCenter']->bak_title_14}}">{{$Setting['MemberCenter']->bak_title_14}}</a></div>
            </li>
          </ul>
        </div>
      </section>
    </main>
    {{-- <!-- 頁尾--> --}}
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/member.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop