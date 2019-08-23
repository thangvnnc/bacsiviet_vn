<!doctype html>
<html prefix="og: http://ogp.me/ns#">
<head prefix="og: http://ogp.me/ns#">
    <link rel="stylesheet" href="/public/v2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="/public/v2/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" media="all">
    
    <!----------------------->
    <script src="/public/v2/js/jquery.min.js"></script>
    <script src="/public/v2/js/jquery-ui.min.js"></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-138149020-1"></script>

    <script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-138149020-1');
	</script>
	<script type="text/javascript">
        //Lấy thông tin môi trường ngôn ngữ mình set
        let envLang = localStorage.getItem('lang');
        var userLang = navigator.language || navigator.userLanguage; 
       if (envLang === null)
       {
            if (userLang.includes('en'))
            {                   
                window.location="https://medixlink.com/en";
            }
        }  
        localStorage.setItem('lang', ''); 
    </script>

</head>

<body class="home">
<header>

    <div class="top-nav">
        <div class="inner">
            <div class="logo"><a href="/"><img src="/public/v2/img/logo.png" alt=""></a></div>

            <div class="search-holder">
                <div class="group-search">
                    <div class="input">
                        <form id="search-query" method="get" action="/tim-kiem" name="global-search">
                            <input name="q" type="text" placeholder="Triệu chứng, bác sĩ, cơ sở y tế..">
                            <a href="javascript:{}" onclick="document.getElementById('search-query').submit();"
                               class="search-go"><i class="fas fa-search"></i></a>
                        </form>
                    </div>
                </div>
            </div>

            <nav class="">
                <ul class="menu-h">
                    <li class="active"><a href="/"><i class="fas fa-home"></i></a></li>
                    <li>
                        <div class="dropdown">
                            <span key="cate" class="langtr">Danh mục</span>
                            <div class="dropdown-content">
                                <a href="/danh-sach-bac-si" class="langtr" key="doc">Bác sĩ</a>
                                <a href="/danhsach-phongkham"  class="langtr"key="cli">Phòng Khám</a>
                                <a href="/danh-sach-nha-thuoc" class="langtr" key="drug">Nhà thuốc</a>
                                {{--<a href="/danh-sach">Cơ sở y tế</a>--}}
                                <a href="/benh" class="langtr" key="sick">Bệnh</a>
                                <a href="/thuoc-danhsach" class="langtr" key="medic">Thuốc</a>
                            </div>
                        </div>
                    </li>
                    <li><a href="/hoibacsi" class="langtr" key="askd">Hỏi bác sĩ</a></li>
                    <li><a href="/baiviet" class="langtr" key="news">Tin tức</a></li>
                    <li><a href="/hoibacsi/datcauhoi" class="langtr" key="ques">Đặt câu hỏi</a></li>
                    <li><a href="/khuyenmai" class="langtr" key="prom">Khuyến mãi</a></li>
                   
                    @if(Session::get('user')!=null)
                        <li>
                            <div class="dropdown">
                                 <span>{{Session::get('user')->fullname}}</span>
                                <div class="dropdown-content">
                                    <a href="/taikhoan" class="langtr" key="acc">Quản lý tài khoản</a>
                                    <a href="/dang-xuat" class="langtr" key="logout">Đăng Xuất</a>
                                </div>
                            </div>
                        </li>
                    @endif
                   
                    <li class="lang-en">
                        <img src="/public/v2/img/gb.png" id="img-en" alt="">
                        <img src="/public/v2/img/vn.png" id="img-vi" alt="">
                        <label for="click" class="langtr" key="changel">Tiếng Việt</label>
                        <input type="checkbox" id="click">
                        <ul class="sub-langs">
                            <li ><img src="/public/v2/img/gb.png" alt=""> <a href="/en"  class="translate" id="en" class="langtr" key="cen"> English</a></li>
                            <li ><img src="/public/v2/img/vn.png" alt=""> <a href="/home" class="translate langtr"  key="cvi" id="vi"> Tiếng Việt</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="menubtns">
                <label class="open-lb show"><i class="fas fa-bars"></i></label>
                <label class="close-lb"><i class="fas fa-minus"></i></label>
            </div>
        </div>
    </div>
</header>
<br><br><br><br>