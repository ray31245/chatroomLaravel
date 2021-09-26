$(document).ready(function () {    
    $('body').on('click', '.shareWebBtn', function () {

        var url = encodeURIComponent(document.URL);
        var title = encodeURIComponent(document.title);
        var link = location.href;
        var baseUrl = $('.base-url').val();

        if ($(this).hasClass('Facebook')) {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + url + '&quote=' + url);
        }

        if ($(this).hasClass('Douban')) {
            window.open('http://www.douban.com/share/service?image=&href=' + url + '&name=&text=' + title);
        }

        if ($(this).hasClass('Baidu')) {
            window.open('http://tieba.baidu.com/f/commit/share/openShareApi?title=' + title + '&desc=&pic=&url=' + url);
        }

        if ($(this).hasClass('Twitter')) {
            window.open('https://twitter.com/intent/tweet?text=' + title + ':%20' + url);
        }

        if ($(this).hasClass('Line')) {
            window.open('http://line.naver.jp/R/msg/text/?' + url);
        }

        if ($(this).hasClass('Google')) {
            window.open('https://plus.google.com/share?url=' + url);
        }

        if ($(this).hasClass('Tumblr')) {
            window.open('http://www.tumblr.com/share?v=3&u=' + url + '&quote=' + title);
        }

        if ($(this).hasClass('Pinterest')) {
            window.open('http://pinterest.com/pin/create/button/?url=' + url + '&description=' + title);
        }

        if ($(this).hasClass('Pocket')) {
            window.open('https://getpocket.com/save?url=' + url + '&title=' + title);
        }

        if ($(this).hasClass('Reddit')) {
            window.open('http://www.reddit.com/submit?url=' + url + '&title=' + title);
        }

        if ($(this).hasClass('LinkedIn')) {
            window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + url + '&title=' + title);
        }

        if ($(this).hasClass('WordPress')) {
            window.open('http://wordpress.com/press-this.php?u=' + url + '&quote=' + title);
        }

        if ($(this).hasClass('Pinboard')) {
            window.open('https://pinboard.in/popup_login/?url=' + url + '&title=' + title);
        }

        if ($(this).hasClass('Email')) {
            window.open('mailto:?subject=' + title + '&body=' + url);
        }
        if ($(this).hasClass('Instagram')) {
            window.open('https://www.instagram.com/');
        }

        if ($(this).hasClass('icon-wechat')) {
            url = link.replace(/\ /g, '*');
            url = url.replace(/\//g, '^');
            url = url.replace(/\./g, '`');
            url = url.replace(/\?/g, '@');
            window.open(baseUrl + "/qrcode/url/" + url, "", "toolbar=no,location=no,directories=no,width=300,height=350");
        }

    });
});
