<!DOCTYPE html>
<html>

<head itemscope="itemscope" itemtype="http://schema.org/WebSite">
    <meta http-equiv="content-language" content="zh-TW" />
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />
    <title>Mail - Demo</title>
    <style>
        :root {
            background: #f5f6fa;
            color: #000000;
            font: 1rem "PT Sans", sans-serif;
        }

        html,
        body,
        .container {
            height: 100%;
        }

        a {
            color: inherit;
        }

        a:hover {
            color: #7f8ff4;
        }

        .container {
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .btn {
            display: inline-block;
            background: transparent;
            color: inherit;
            font: inherit;
            border: 0;
            outline: 0;
            padding: 0;
            -webkit-transition: all 200ms ease-in;
            transition: all 200ms ease-in;
            cursor: pointer;
        }

        .btn--primary {
            background: #7f8ff4;
            color: #fff;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
            border-radius: 2px;
            padding: 12px 36px;
        }

        .btn--primary:hover {
            background: #6c7ff2;
        }

        .btn--primary:active {
            background: #7f8ff4;
            box-shadow: inset 0 0 10px 2px rgba(0, 0, 0, 0.2);
        }

        .btn--inside {
            margin-left: -96px;
        }

        .form__field {
            width: 360px;
            background: #fff;
            color: #a3a3a3;
            font: inherit;
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.1);
            border: 0;
            outline: 0;
            padding: 22px 18px;
            width: 600px;
        }
        .form__field.Area {
            display: block;
            margin-bottom: 20px;
            height: 600px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container__item">
            <form class="form">
                <textArea id="html" type="text" class="form__field Area" placeholder="mail html" /></textArea>
                <input id="mail" type="email" class="form__field" placeholder="mail address" />
                <button type="button" class="btn btn--primary btn--inside uppercase" onclick="sendMail()">Send</button>
            </form>
        </div>
    </div>
</body>


<script type="text/javascript">
	var sendTime;
    const urlPath = location.protocol + '//'+location.hostname + '/tw/mail/send';
    function sendMail() {
        clearTimeout(sendTime);
        sendTime = setTimeout(function () {            
            let data = {
                    html: document.getElementById('html').value,
                    mail: document.getElementById('mail').value,
                    _token:'{{ csrf_token() }}'
                };                
            $.ajax({
                url: urlPath,
                type: 'post',
                data: data
            }).done(function (feedback) {
                alert('Wilson is good');
                document.getElementById('html').value='';
            });
        }, 333);
    }	
</script>
<script src="/dist/assets/js/plugins-dist.js"></script>

</html>