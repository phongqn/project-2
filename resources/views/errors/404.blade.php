<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lỗi</title>
</head>

<body>
    <b:if cond='data:blog.pageType == &quot;error_page&quot;'>
        <style type='text/css'>
            body {
                overflow: hidden !important
            }

            #error-page-bsw {
                position: relative;
                display: table;
                width: 100%;
                height: 100vh;
                margin: 0 !important;
                padding: 0 !important;
                z-index: 999;
                background: url(https://4.bp.blogspot.com/-Puc43u-sEYM/Wf3Fat9-PCI/AAAAAAAAACk/z4qrDlCMk-M8-28KILqGlRwE5-_B1O6WQCLcBGAs/s1600/background_full_Intro_bacsiwindows-com.jpg) no-repeat center center !important;
                background-size: cover !important
            }

            #error-page-bsw:before {
                content: '';
                opacity: 1;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 0;
                background: linear-gradient(transparent, #050a18)
            }

            #error-page-bsw:after {
                content: '
 '
;
                z-index: 0;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-image: linear-gradient(transparent, rgba(51, 51, 51, 0.15) 0%, rgba(12, 23, 36, 0.4))
            }

            .error-page-bsw_content {
                position: relative;
                z-index: 3
            }

            .intro_label h2 {
                font-size: 45px;
                font-weight: 700;
                color: rgba(255, 255, 255, .85);
                margin: 0 0 .5em;
                padding: 0;
                font-family: "
 Roboto Condensed"
,
                    sans-serif;
                text-transform: uppercase
            }

            .intro_label p {
                text-transform: uppercase;
                font-size: 16px;
                font-weight: 400;
                color: rgba(255, 255, 255, 0.7);
                margin: 0;
                padding: 0;
                letter-spacing: 2px
            }

            .intro_label {
                margin: 0 auto;
                text-align: center;
                padding: 0
            }

            .btn-error-page {
                color: rgba(255, 255, 255, .5) !important;
                padding: 8px 25px;
                display: inline-block;
                margin: 1.5em .5em;
                border-radius: 50px;
                text-transform: uppercase;
                border: 1px solid rgba(255, 255, 255, .3);
                font-size: 14px;
                font-weight: 500;
            }

            .btn-error-page:hover {
                background: rgba(255, 255, 255, .15)
            }

            .meta_ {
                display: table-cell;
                vertical-align: middle;
                text-align: center
            }
        </style>
        <div id='error-page-bsw'>
            <div class='meta_'>
                <div class='error-page-bsw_content'>
                    <div class='intro_label'>
                        <h2 class='_title'><i aria-hidden='true' class='fa fa-gg' style='margin:0 20px 0 0' />404 - PAGE NOT FOUND<i aria-hidden='true' class='fa fa-gg' style='margin:0 0 0 20px' /></h2>
                        <p>Lỗi cmnr, sao bạn lạc trôi tới đây được vậy!?</p>
                        <a class='btn-error-page' href='/contact'>Liên hệ - báo lỗi</a><a class='btn-error-page' href='/'>Về trang chủ</a><a class='btn-error-page' href='#go_back' onclick='goBack()'>Quay lại trang trước</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </b:if>
</body>

</html>