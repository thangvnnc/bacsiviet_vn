<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3589565635207321",
            enable_page_level_ads: true
        });
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" ccomponentontent="Bac si Viet">
    <meta name="keywords"
          content="Medical, medihere, Doctor, HTML5, Bootstrap, Popular, custom, clinic, health-care, template, theme"/>
    <meta name="author" content="Mostafiz">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$thumbnail or null}}"/>

    <link rel="apple-touch-icon" sizes="57x57" href="/public/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/public/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/public/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/public/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/public/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/public/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/public/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/public/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/public/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/public/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/images/favicon-16x16.png">
    <link rel="manifest" href="/public/images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/public/images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>{{$title or "Chọn bệnh viện, bác sĩ, phòng khám và tra cứu thuốc, bệnh để chăm sóc sức khỏe tốt nhât |
        medixlink.com"}} </title>
    <!-- Stylesheets -->
    <!-- preloader css -->
    <!--<link rel="stylesheet" href="/public/css/introLoader.min.css" media="none" onload="if(media!='all')media='all'">-->
    <!-- animate css -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">

    <link rel="stylesheet" href="/public/css/animate.css" type="text/css"/>
    <!-- owl carousel styles -->
    <link rel="stylesheet" href="/public/css/owl.carousel.css" type="text/css"/>
    <!-- date picker css -->
    <!-- main style -->
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/font-awesome.min.css">
    <!-- google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800,600' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,500' rel='stylesheet' type='text/css'>
    <!-- modernizr -->
    <script async src="/public/js/modernizr.js "></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
            type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="/public/css/circle.css"/>
    <script async src="/public/js/circle.js "></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body style="line-height: 0px">

<!-- Document Wrapper
============================================= -->
<main id="homepage">
    <div class="component">
        {{--<img src="/public/images/logo.png" style="height: inherit"/>--}}
        <!-- Start Nav Structure -->

        <button class="cn-button" id="cn-button">Menu</button>
        <div class="cn-wrapper" id="cn-wrapper">
            <ul>
                <li class="one-line">
                    <a href="/">
                        <span>Home</span>
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a class="@yield('hoi-bac-si')" href="/hoi-bac-si" title="Hỏi bác sĩ">
                        <span>Hỏi bác sĩ</span>
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a href="/bai-viet" class="@yield('bai-viet')" title="Bài viết">
                        <span>Bài viết</span>
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a href="/benh" class="@yield('benh')" title="Bệnh">
                        <span>Bệnh</span>
                        <i class="fa fa-bed" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a href="/thuoc" class="@yield('thuoc')" title="Thuốc">
                        <span>Thuốc</span>
                        <i class="fa fa-toggle-on"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a href="/danh-sach/bac-si" class="@yield('bac-si')" title="Bác sĩ">
                        <span>Bác sĩ</span>
                        <i class="fa fa-fw fa-user-md"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a href="/danh-sach" class="@yield('co-so-y-te')" title="Cơ sở y tế">
                        <span>Phòng Khám</span>
                        <i class="fa fa-fw fa-hospital-o"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a class=" login-overlay-trigger" href="/dang-nhap/">
                        <span>Đăng nhập</span>
                        <i class="fa fa-fw fa-sign-in" aria-hidden="true" rel="nofollow"></i>
                    </a>
                </li>
                <li class="two-line">
                    <a href="/messages" class="@yield('khuyen-mai')" title="Chat với bác sĩ">
                        <span>Chat với<br>bác sĩ</span>
                        <i class="fa fa-gift" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="one-line"><a href="#"><span></span></a></li>
                <li class="one-line">
                    <a class=" signup-overlay-trigger" href="/dang-ky">
                        <span>Đăng ký</span>
                        <i class="fa fa-fw fa-user-plus" aria-hidden="true" rel="nofollow"></i>
                    </a>
                </li>
                <li class="one-line">
                    <a href="/khuyen-mai" class="@yield('khuyen-mai')" title="Khuyến mãi">
                        <span>Khuyến mãi</span>
                        <i class="fa fa-gift" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End of Nav Structure -->

        <script>
            function eventFire(el, etype) {
                if (el.fireEvent) {
                    el.fireEvent('on' + etype);
                } else {
                    var evObj = document.createEvent('Events');
                    evObj.initEvent(etype, true, false);
                    el.dispatchEvent(evObj);
                }
            }

            document.addEventListener("DOMContentLoaded", function (event) {
                eventFire(document.getElementById('cn-button'), 'click');
            });
        </script>
    </div>
    <!-- // Preloader markup -->
    <div id="element" class="introLoading"></div>

    <!-- Header
    ============================================= -->
    <header id="header" class="navbar-fixed-top" style="border-bottom: #fff">
        <div id="header-wrap">
            <div class="position">
                <nav class="navbar navbar-default">
                    <div class="">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <!-- Logo ============================================= -->
                            <div id="logo">
                                <a href="/" class="medihere-logo"><img style="max-width: 155px"
                                                                       src="/public/images/logo.png" alt="medihere Logo"
                                                                       title="medihere"></a>
                            </div>
                            <!-- #logo end -->
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </header>
    <!-- #header end -->
