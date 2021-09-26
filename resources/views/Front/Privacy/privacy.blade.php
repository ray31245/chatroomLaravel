@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/privacy.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'privacy')
@section('bodyDataPage', 'privacy')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <section class="privacy_bn">
        <!-- 電腦 1920*750 // 平板 1200*700 // 手機 600*1200 // 換圖結構在下面-->
        <div class="privacy_bg" style="background-image: url(/dist/uploads/privacy/privacy_bn.jpg)"></div>
        <div class="bn_title waypoint">
          <h1 class="title_head">Privacy Policy</h1>
          <div class="subtitle">Hey,privacy policy was updated on January 01, 2020.</div>
          <p>We take your privacy very seriously. Therefore, we have a privacy policy that sets out how we collect, use, disclose, transmit and store your personal information.In addition to this privacy policy, we also provide data and privacy related information in our products for specific functions that require the use of your personal information. Just click the tex to read it.Before enabling such features, you can read this information in the relevant Settings and / or online. Please take the time to learn more about our privacy practices, and please let me know if you have any questions.</p>
        </div>
      </section>
      <section class="privacy_ct">
        <div class="common_wrap">
          <div class="privacy_li waypoint">
            <h2 class="privacy_title">I-Scope of privacy protection policy</h2>
            <div class="privacy_p">The privacy protection policy includes how this website handles personally identifiable information collected when you use the website services. The privacy protection policy does not apply to related linked sites other than this site, nor does it apply to persons not commissioned or involved in the management of this site.</div>
          </div>
          <div class="privacy_li waypoint">
            <h2 class="privacy_title">II-Collection, processing and utilization of personal data</h2>
            <div class="privacy_p">• When you visit this website or use the functional services provided by this website, we will, depending on the nature of the service functions, ask you to provide the necessary personal data, and to process and use your personal data within this specific purpose; You agree in writing that this website will not use personal data for other purposes.<br/>• When you use interactive features such as service mailboxes and questionnaires, this website will retain your name, email address, contact information, and use time.<br/>• During normal browsing, the server will record relevant behaviors by itself, including the IP address of the connected device, the time of use, the browser used, browsing and clicking data records, etc., as a reference basis for us to improve our website services This record is an internal application and will never be made public.<br/>• In order to provide accurate services, we will collect and analyze the content of the questionnaires. The statistical data or explanatory texts of the analysis results will be presented. In addition to internal research, we will publish statistical data and explanatory texts as needed, but not related Specific personal information.</div>
          </div>
          <div class="privacy_li waypoint">
            <h2 class="privacy_title">III-Protection of data</h2>
            <div class="privacy_p">• The host of this website is equipped with various information security equipment and necessary security protection measures, such as firewalls and anti-virus systems. To protect the website and your personal data, strict protection measures are used. Only authorized personnel can access your Personal data and related processing personnel have signed confidentiality contracts, and those who violate the confidentiality obligations will be subject to relevant legal sanctions.<br/>• If it is necessary to entrust other units to provide services due to business needs, this website will also strictly require them to comply with confidentiality obligations and take necessary inspection procedures to determine that they will indeed comply.</div>
          </div>
          <div class="privacy_li waypoint">
            <h2 class="privacy_title">IV-The external links of the website</h2>
            <div class="privacy_p">The pages on this website provide links to other websites. You can also click on the links provided on this website to enter other websites. However, the linked site's privacy protection policy is not applicable. You must refer to the privacy protection policy of the linked site.</div>
          </div>
          <div class="privacy_li waypoint">
            <h2 class="privacy_title">V-Policy for sharing personal data with third parties</h2>
            <div class="privacy_p">This website will never provide, exchange, rent or sell any of your personal data to other individuals, groups, private enterprises or public agencies, but it has no legal basis or contractual obligations.<br/>The proviso of the preceding paragraph includes, but is not limited to:<br/>• With your written consent.<br/>• Expressly provided by law.<br/>• To avoid danger to your life, body, freedom, or property.<br/>• Cooperate with public authorities or academic research institutions, necessary for statistical or academic research based on the public interest, and the data is processed or collected by the provider, and the specific parties cannot be identified in accordance with their disclosure methods.<br/>• When your behavior on the website violates the terms of service or may damage or obstruct the rights of the website and other users or cause damage to anyone, the website management unit analyzes and discloses your personal data to identify, contact or take legal action Necessary.<br/>• Benefit your interests.<br/>• When this website entrusts manufacturers to assist in the collection, processing or use of your personal data, it will be responsible for the supervision and management of outsourced manufacturers or individuals.</div>
          </div>
          <div class="privacy_li waypoint">
            <h2 class="privacy_title">VI-Use of Cookies</h2>
            <div class="privacy_p">In order to provide you with the best service, this website will place and access our cookies on your computer. If you do not want to accept the writing of cookies, you can set the privacy level in the features of the browser you use as High, you can reject the writing of cookies, but may cause some functions of the website to not work properly.<br/>Amendments to the privacy protection policy<br/>This website's privacy protection policy will be amended at any time as needed, and the revised terms will be posted on the website.</div>
          </div>
        </div>
      </section>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .privacy_bg{
          background-image: url('/dist/uploads/privacy/privacy_bn_pad.jpg') !important
        }
      }
      @media only screen and (max-width: 767px){
        .privacy_bg{
          background-image: url('/dist/uploads/privacy/privacy_bn_phone.jpg') !important
        }
      }
      
    </style>
    <!-- 頁尾-->
    @include('Front.layout.footer')
    @section('script')
    {{-- <script src="/assets/js/plus/product.js?v={{BaseFunction::getV()}}"></script>   --}}
    @stop
    @stop