<!DOCTYPE html>
<html lang="en">

    <head itemscope="itemscope" itemtype="http://schema.org/WebSite">
        
		@if(\Illuminate\Support\Str::contains(url()->current(), 'wdd.idv.tw'))
            {{--  禁止搜尋引擎建立該網頁的索引，請於專案尚未上正式上架前保留這個設定，也請後端工程師把此設定放進後端管理中 --}}
            <meta name="robots" content="noindex" />    
            {{--  禁止 Google 該網頁建立索引，請於專案尚未上正式上架前保留這個設定，也請後端工程師把此設定放進後端管理中 --}}
            <meta name="googlebot" content="noindex" />
        @endif

        {{--  網站語系及語言宣告 --}}
        <meta http-equiv="content-language" content="zh-TW" />
        <meta charset="UTF-8" />
        
        {{--  RWD設定 --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        
        {{--  瀏覽器設定 --}}
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />   
        
        {{-- 網站標題 --}}
        @if(isset($seo['web_title']))
            <title>{{ $seo['web_title'] }}</title>
            <meta property="og:title" content="{{ $seo['og_title'] }}" />
            <meta itemprop="name" content="{{ $seo['web_title'] }}" />
            <meta name="twitter:title" content="{{ $seo['og_title'] }}" />        
            <meta name="twitter:site" content="{{ $seo['og_title'] }}" />
            <meta name="twitter:creator" content="{{ $seo['og_title'] }}" />
        @endif
        
        {{--  網頁內容描述 --}}
        @if(isset($seo['meta_description']) && !empty($seo['meta_description']))
            <meta name="description" content="{{ $seo['meta_description'] }}" />    
            <meta itemprop="description" content="{{ $seo['meta_description'] }}" />        
            <meta name="twitter:description" content="{{ $seo['meta_description'] }}" /> 
        @endif

        @if(isset($seo['og_description']) && !empty($seo['og_description']))
            <meta property="og:description" content="{{ $seo['og_description'] }}" />           
            <meta property="og:site_name" content="{{ $seo['og_description'] }}" />
        @endif
        
        {{--  網站關鍵字 --}}
        @if(isset($seo['meta_keyword']) && !empty($seo['meta_keyword']))
            <meta name="keywords" content="{{ $seo['meta_keyword'] }}">
        @endif	
        
        {{-- 圖像 --}}
        @if(isset($seo['og_image']) && $seo['og_image'] != 0)        
            <meta property="og:image" content="{{ URL::to('/') . BaseFunction::RealFiles($seo['og_image'])}}" />        
            <meta itemprop="image" content="{{URL::to('/') .BaseFunction::RealFiles($seo['og_image'])}}" />        
            <meta name="twitter:card" content="{{URL::to('/') .BaseFunction::RealFiles($seo['og_image'])}}" />        
            <meta name="twitter:image:src" content="{{URL::to('/') .BaseFunction::RealFiles($seo['og_image'])}}" />  
        @endif

        {{--  Open Graph Protocol for facebook --}}
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:locale" content="zh_TW" />
        <meta property="og:type" content="website" />
        
        {{--  重複網址的導向設定 : 被認定為主要網址的宣告，如不須禁止則全部刪除，請後端工程師把此設定放進後端管理中 --}}
        <link rel="canonical" href="{{ url()->current() }}" itemprop="url" />
        <link rel="shortcut icon" type="image/x-icon" href="/Favicon.png">
        <link rel="icon" type="image/x-icon" href="/Favicon.png">
        <link rel="apple-touch-icon" href="/Favicon.png">

        {{--  Google Tag Manager --}}
        @if(isset($seo['ga_code']) && !empty($seo['ga_code']))
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '{{$seo['ga_code']}}', 'auto');
                ga('send', 'pageview');
            </script>
        @endif

        @if( !empty($seo['gtm_code']) )
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $seo['gtm_code'] }}');</script>
        @endif  
        @if( !empty($seo['gtag']) )
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id={{$seo['gtag']}}"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{$seo['gtag']}}');
            </script>
        @endif  

		<link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
		<link rel="icon" type="image/x-icon" href="/favicon.png">
        <link rel="apple-touch-icon" href="/favicon.png">
        
		<link rel="stylesheet" href="{{asset('dist/assets/css/style.css?v='.BaseFunction::getV())}}"/>
		<!-- 非共用的Css --> 
		@yield('css')
        <!-- 非共用的Css(絕對後面那種) --> 	  	
         @yield('css_back')

	</head>

	<body class="@yield('bodyClass')" id="@yield('bodyId')" data-page="@yield('bodyDataPage')">
		<input class="base-url" type="hidden" value="{{ BaseFunction::b_url('/') }}">
		<input class="base-locatoin" type="hidden" value="{{ $baseLocale }}">
        <input  id="_token" type="hidden"  name="_token" value="{{ csrf_token() }}">
        @if (Session::has('fantasy_user') && preg_match("/preview./",$_SERVER['HTTP_HOST']) && Session::get('fantasy_user')['id']=='1')
        <p style="display: none" class='iframe' href="http://wikipedia.com">Outside Webpage (Iframe)</p>
        @endif
		@yield('content')
		
		<!-- 套件js-->
        <script src="{{asset('dist/assets/js/vender-dist.js?v='.BaseFunction::getV())}}"></script>
        
		<!-- 自訂的 js-->
		<script src="{{asset('dist/assets/js/wdd.1.2.1-dist.js?v='.BaseFunction::getV())}}"></script>
		<script src="{{asset('dist/assets/js/wdd_ajax.1.1.2-dist.js?v='.BaseFunction::getV())}}"></script>
		<script src="{{asset('dist/assets/js/main-dist.js?v='.BaseFunction::getV())}}"></script>
		<!-- 非共用的JS --> 

        {{-- 後端JS --}}
        <script src="/assets/js/plus/all.js?v={{BaseFunction::getV()}}"></script>  
        <script src="/assets/js/plus/webshare.js?v={{BaseFunction::getV()}}"></script>  
		<script src="/assets/js/plus/jquery.colorbox.js?v={{BaseFunction::getV()}}"></script>
	  	@yield('script')
	  	{{-- 非共用的JS區塊(更後面) --}}
        @yield('script_back')
        @if (Session::has('fantasy_user') && preg_match("/preview./",$_SERVER['HTTP_HOST']) && Session::get('fantasy_user')['id']=='1')
            <script>
                $(document).ready(function(){
                    $(".iframe").colorbox({
                    href: 'http://changei.wdd.idv.tw/Fantasy/Cms/changei/tw/1/2',
                    iframe:true,
                    width:"80%",
                    height:"80%",
                    overlayClose: false,
                    onClosed: function(){  
                        //location.reload();
                        
                    },
                    onComplete: function() {
                        $('#cboxClose, #cboxOverlay').on('click', function() {
                            $('html').css('overflow-y','auto');
                        });

                    }}); 
                    $(".iframe").click(function(event){
                    event.preventDefault();
                    });   
                });
            </script>  
        @endif
		<!-- JSON-LD-->
		{!!$seo['schema_code']!!}
        <script type="application/ld+json">
            {
                "@context": "http://www.schema.org",
                "@type": "BreadcrumbList",
                "itemListElement":
                [
                    @php
                        $count = count($seo['BreadcrumbList']);
                    @endphp
                    @foreach ($seo['BreadcrumbList'] as $key => $value)
                    {
                        "@type": "ListItem",
                        "position": {{$key+1}},
                        "item":
                        {
                        "@id": "{{ $value['id'] }}",
                        "name": "{{ $value['name'] }}"
                        }
                    }
                    @if ($key+1!=$count)
                    ,
                    @endif
                    @endforeach
                ]
            }
        </script>
	</body>

</html>