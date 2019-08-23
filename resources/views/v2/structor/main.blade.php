<head prefix="og: http://ogp.me/ns#">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--FACEBOOK-->
    <meta property="og:locale" content="en_us" />
    <meta property="og:locale:alternate" content="ar_ar" />
    <meta property="og:image" content="https://medixlink.com/public/v2/img/logo2.png">
    <meta property="og:image:secure_url" content="https://medixlink.com/public/v2/img/logo2.png" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="620">
    <meta property="og:type" content="company" />
    <meta property="og:url" content="https://medixlink.com"/>
    <meta property="og:title" content="Hãy gọi cho chúng tôi ngay" />
    <meta property="og:description" content="Hệ thống y tế trực tuyến tại Việt Nam với hơn 1000 bác sĩ giỏi" />
    <meta property="fb:app_id" content="130864624263329" />

    <title>{{$title or "Medixlink"}} </title>
</head>
@include('v2.structor.header')
	@yield('content')
@include('v2.structor.footer')
