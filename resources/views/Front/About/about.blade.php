@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/about.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'about')
@section('bodyDataPage', 'about')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      <section class="about_bn">
        <!-- 電腦 1920*750 // 平板 1200*700 // 手機 600*825 // 換圖結構在下面-->
        <div class="about_bg" style="background-image: url({{basefunction::RealFiles($Setting->banner)}}"></div>
        <div class="bn_title waypoint">
          <h1 class="title_head">{{$Setting->banner_title}}</h1>
          <p>{{$Setting->banner_sub_title}}</p>
        </div>
      </section>
      <section class="about_ct">
        <div class="common_wrap">
          <div class="about_article waypoint">
            <div class="about_pic"><img src="/dist/uploads/about/about_ct1.jpg" alt=""/></div>
            <div class="about_word">
              <div class="about_word_wrap">
                <div class="about_subtitle">We have both</div>
                <div class="about_title">TECHNOLOGY X IDEA</div>
                <div class="about_p">Changei, the same sound as "sincere love", we take honesty and love as the positioning of the company culture. Provide customers with peace of mind technical support based on integrity. The company's operation is based on "love", creating a happy working atmosphere and fostering positive common beliefs.</div>
              </div>
            </div>
          </div>
          <div class="about_ul waypoint">
            <div class="about_li">
              <div class="about_li_wrap">
                <div class="li_pic"><span class="icon-icon4"></span></div>
                <div class="li_word">
                  <div class="li_title">Screen Protectors</div>
                  <div class="li_p">Development expert of screen protector for iPhone</div>
                </div>
              </div>
            </div>
            <div class="about_li">
              <div class="about_li_wrap">
                <div class="li_pic"><span class="icon-icon5"></span></div>
                <div class="li_word">
                  <div class="li_title">Ci madhouse</div>
                  <div class="li_p">We are a group of product innovation and R & D teams.</div>
                </div>
              </div>
            </div>
            <div class="about_li">
              <div class="about_li_wrap">
                <div class="li_pic"><span class="icon-icon6"></span></div>
                <div class="li_word">
                  <div class="li_title">Ci tech.</div>
                  <div class="li_p">A professional supplier of products and services.</div>
                </div>
              </div>
            </div>
          </div>
          <div class="about_step waypoint">
            <div class="step_head">
              <div class="about_subtitle">Ci product design  Brand Woo</div>
              <div class="about_title">“ We continue and focus on doing one thing well, that is Woo ”</div>
            </div>
            <div class="step_img"><img src="/dist/uploads/about/about_ct2.jpg" alt=""/></div>
            <div class="step_ul waypoint">
              <div class="step_li">
                <div class="step_li_wrap">
                  <div class="step_title">Independent project team</div>
                  <div class="step_p">Each product project has a responsible project team to conduct research and development to ensure that the product can be designed and developed quickly and accurately without interference.</div>
                </div>
              </div>
              <div class="step_li">
                <div class="step_li_wrap">
                  <div class="step_title">Define strategy</div>
                  <div class="step_p">Project managers analyze market positioning and plan product marketing strategies.</div>
                </div>
              </div>
              <div class="step_li">
                <div class="step_li_wrap">
                  <div class="step_title">Published after review</div>
                  <div class="step_p">The brand leader conducts a final review of the project plan and releases it to the market.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .about_bg{
          background-image: url('/dist/uploads/about/about_bn_pad.jpg') !important
        }
      }
      @media only screen and (max-width: 767px){
        .about_bg{
          background-image: url('/dist/uploads/about/about_bn_phone.jpg') !important
        }
      }
      
    </style>
    {{-- <!-- 頁尾--> --}}
    @include('Front.layout.footer')
    @section('script')
    {{-- <script src="/assets/js/plus/home.js?v={{BaseFunction::getV()}}"></script>   --}}
    @stop
    @stop