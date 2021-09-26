@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/contact.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'contact')
@section('bodyDataPage', 'contact')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <section class="contact_bn">
        <!-- 電腦 1920*450 // 平板 1200*400 // 手機 600*600 // 換圖結構在下面-->
        <div class="contact_bg" style="background-image: url({{basefunction::RealFiles($Setting->banner)}})"></div>
        <div class="bn_title waypoint">
          <h1 class="title_head">{{$Setting->banner_title}}</h1>
          <p>{{$Setting->banner_sub_title}}</p>
        </div>
      </section>
      <section class="contact_ct">
        <div class="contact_ul"><a class="contact_li {{key($tabArr)==0?'active':''}}" taburl="{{$tabArr[0]}}" href="javascript:;">INFORMATION</a><a class="contact_li {{key($tabArr)==1?'active':''}}" taburl="{{$tabArr[1]}}" href="javascript:;">SEND A MAIL</a></div>
        <div class="contact_tab">
          <div class="tab_obj infor">
            <div class="ct_title waypoint">
              <div class="title_head">{{$Setting->view_title}}</div>
              <p>{{$Setting->view_title_sub}}</p>
            </div>
            <div class="contact_swiper waypoint">
              <div class="swiper-container swiper4" data-swiper-id="contact_sw" data-swiper-num="1" data-swiper-arrow="on" data-swiper-arrow-name=".contact_sw" data-swiper-nav="off" data-swiper-autoplay="on" data-swiper-loop="on">
                <div class="swiper-wrapper">
                  {{-- <!-- banner 圖片尺寸 PC 1920*1080(px) / RWD  700*1245(px)--> --}}
                  @foreach ($Banner_list as $key => $value)
                  <div class="swiper-slide">
                    <div class="hero-banner">
                      <picture>
                        <source media="(max-width: 767px)" srcset="{{array_search($value->img2,$imageAry)}}"/><img src="{{array_search($value->img,$imageAry)}}" alt="banner"/>
                      </picture>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="contact_sw-Next contact_sw icon-arrow_right"></div>
              <div class="contact_sw-Prev contact_sw icon-arrow_left"></div>
            </div>
            <div class="contact_way">
              <div class="way_li waypoint">
                <div class="way_top"><span class="icon-contact1"></span>
                  <div class="way_title">{{$Setting->bak_title_13}}</div>
                </div>
                <div class="way_p">{!!nl2br($Setting->bak_intro_1)!!}</div>
              </div>
              <div class="way_li waypoint">
                <div class="way_top"><span class="icon-contact2"></span>
                  <div class="way_title">{{$Setting->bak_title_14}}</div>
                </div>
                <div class="way_p">{!!nl2br($Setting->bak_intro_2)!!}</div><a class="icon-right" href="{{$Setting->bak_intro_3?"https://www.google.com.tw/maps/place/".$Setting->bak_intro_3:"javascript:;"}}" {{$Setting->bak_intro_3?'target=_blank':''}}></a>
              </div>
              <div class="way_li waypoint">
                <div class="way_top"><span class="icon-contact3"></span>
                  <div class="way_title">{{$Setting->bak_title_15}}</div>
                </div>
                <div class="way_p">{!!nl2br($Setting->bak_intro_4)!!}</div><a class="icon-right" href="{{$Setting->bak_title_16?'tel:'.preg_replace('/[^\d]/is','',$Setting->bak_title_16):''}}" {{$Setting->bak_title_16?'target=_blank':''}}></a>
              </div>
            </div>
          </div>
          <div class="tab_obj form">
            <div class="ct_title waypoint">
              <div class="title_head">Send a mail to us</div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna animunde omnis iste natus error sit</p>
            </div>
            <div class="block waypoint">
              <div class="block_title">
                <div class="num" num="1"></div>
                <div class="block_name">Your Detail</div>
              </div>
              <div class="form_ct">
                <div class="form_line">
                  <div class="form_list must">
                    <div class="form_input">
                      <input name="tel" type="text" placeholder="{{$Setting->bak_title_1}}"/>
                    </div>
                  </div>
                </div>
                <div class="form_line">
                  <div class="form_list must">
                    <div class="form_input">
                      <input name="name" type="text" placeholder="{{$Setting->bak_title_2}}"/>
                    </div>
                  </div>
                </div>
                <div class="form_line">
                  <div class="form_list">
                    <div class="form_input">
                      <div class="formdd">
                        <div class="formdd_click">
                          <div class="formdd_title" data-reset="Gender">{{$Setting->bak_title_3}}</div>
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
                  <div class="form_list">
                    <div class="form_input">
                      <input name="email" type="text" placeholder="{{$Setting->bak_title_4}}"/>
                    </div>
                  </div>
                </div>
                <div class="form_line">
                  <div class="form_list must add">
                    <div class="form_input">
                      <div class="formdd">
                        <div class="formdd_click">
                          <div class="formdd_title" data-reset="Taiwan">{{$Setting->bak_title_5}}</div>
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
                      <input name="address" type="text" placeholder="{{$Setting->bak_title_6}}"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block waypoint">
              <div class="block_title">
                <div class="num" num="2"></div>
                <div class="block_name">Your Inquiry</div>
              </div>
              <div class="form_ct">
                <div class="form_line">
                  <div class="form_list must">
                    <div class="form_input">
                      <div class="formdd">
                        <div class="formdd_click">
                          <div class="formdd_title" data-reset="Select maintanence type">{{$Setting->bak_title_7}}</div>
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
                      <textarea name="message" placeholder="{{$Setting->bak_title_8}}"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form_line">
                  <div class="form_list must">
                    <div class="form_input">
                      <input type="text" name="captchacode" placeholder="{{$Setting->bak_title_9}}"/><img id="login_indexCapt" src="{{$Captcha['img']}}" data-key="{{$Captcha['key']}}" alt="" onclick="cgCapt('login_indexCapt')"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form_btn"><a class="czbtn clear" href="javascript:;" data-text="Clear">Clear</a><a class="czbtn" href="javascript:;" submitBtn data-text="Sumbit">Sumbit</a></div>
          </div>
        </div>
      </section>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .product_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_pad)}}') !important
        }
      }
      @media only screen and (max-width: 767px){
        .product_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_rwd)}}') !important
        }
      }
      
      
    </style>
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/contact.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop