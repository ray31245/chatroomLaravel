<!DOCTYPE html>
<html lang="en">

<head itemscope="itemscope" itemtype="http://schema.org/WebSite">
    <meta http-equiv="content-language" content="zh-TW" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />

    <title>FESD - Demo</title>
    <link rel="canonical" href="{{ url('/') }}" itemprop="url" />
    <link rel="shortcut icon" href="https://www.wddgroup.com/images/favicon/favicon32.png" type="image/x-icon" />
    <link rel="stylesheet" href="/dist/assets/css/style.css" />
    <link rel="stylesheet" href="/dist/assets/css/product_detail.css" />
</head>

<body class="product_detail" data-page="product_detail">
    <div class="main-wrapper scrollbar-macosx">
        <div class="all-wrapper">
            <main>
                <div class="content-wrapper">
                    <div class="section section4">
                        <div class="container">
                            <div class="sec-title">FESD</div>
                            <div class="sec-subtitle">Article Layout</div>

                            <!--段落編輯器-->
                            <div class="_articleBlock">
                                @include('article_v2',['data'=> $data['DemoArticle'],'three'=>'DemoArticleThree' ])
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer></footer>
        </div>
    </div>
</body>
<!--引入的script-->
<script src="/dist/assets/js/plugins-dist.js"></script>
<script src="/dist/assets/js/fesdDB.1.0-dist.js"></script>
<script src="/dist/assets/js/fesd.1.0-dist.js"></script>
<script src="/dist/assets/js/methods-dist.js"></script>
<script src="/dist/assets/js/main-dist.js"></script>
</html>