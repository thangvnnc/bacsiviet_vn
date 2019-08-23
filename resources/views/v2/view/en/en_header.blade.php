<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title or "Medixlink"}} </title>
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
            if (userLang.includes('vi'))
            {                   
                window.location="https://medixlink.com";
            }
        }  
        localStorage.setItem('lang', ''); 
    </script>
</head>

<body class="home">
<header>
    <div class="top-nav">
        <div class="inner">
            <div class="logo"><a href="/en"><img src="/public/v2/img/logo.png" alt=""></a></div>

            <div class="search-holder">
                <div class="group-search">
                    <div class="input">
                        <form id="search-query" method="get" action="/en/tim-kiem" name="global-search">
                            <input name="q" type="text" placeholder="Symptoms, doctors, medical facilities ...">
                            <a href="javascript:{}" onclick="document.getElementById('search-query').submit();"
                               class="search-go"><i class="fas fa-search"></i></a>
                        </form>
                    </div>
                </div>
            </div>

            <nav class="">
                <ul class="menu-h">
                    <li class="active"><a href="/en"><i class="fas fa-home"></i></a></li>
                    <li>
                        <div class="dropdown">
                            <span >Category</span>
                            <div class="dropdown-content">
                                <a href="/en/danh-sach-bac-si"  >Doctors</a>
                                <a href="/en/danhsach-phongkham"  >Clinic</a>
                                <a href="/en/danh-sach-nha-thuoc" >Drugstore</a>
                                {{--<a href="/danh-sach">Cơ sở y tế</a>--}}
                                <a href="/en/benh"  >Disease</a>
                                <a href="/en/thuoc-danhsach">Medicine</a>
                            </div>
                        </div>
                    </li>
                    <li><a href="/en/hoibacsi">Ask Doctor</a></li>
                    <li><a href="/en/baiviet"  >News</a></li>
                    <li><a href="/en/hoibacsi/datcauhoi"  >Question</a></li>
                    <li><a href="/en/khuyenmai" >Promotion</a></li>
                   
                    @if(Session::get('user')!=null)
                        <li>
                            <div class="dropdown">
                                 <span>{{Session::get('user')->fullname}}</span>
                                <div class="dropdown-content">
                                    <a href="/en/taikhoan" >Account infomation</a>
                                    <a href="/en/dangxuat" >Logout</a>
                                </div>
                            </div>
                        </li>
                    @endif
                   
                    <li class="lang-en" data-id="0">
                        <img src="/public/v2/img/gb.png" id="img-en" alt="">
                        <img src="/public/v2/img/vn.png" id="img-vi" alt="">
                        <label class="langtr" data-id="0" for="click">English</label>
                        <input type="checkbox" id="click">
                        <ul class="sub-langs">
                            <li ><img src="/public/v2/img/gb.png" alt=""> <a href="/en"  class="translate" id="en" > English</a></li>
                            <li ><img src="/public/v2/img/vn.png" alt=""> <a href="/home" class="translate"  id="vi"> VietNamese</a></li>
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
    <script type="text/javascript">
    	 
        
         $(document).ready(function(){
            let path = window.location.pathname;
            let chlangs = $(".translate");
            let tra = $(' .langtr');
            let href = $(chlangs).attr('href');
     		
            if(path.includes("/en")){
               var lang = $(chlangs).attr('id');
                if(lang === "en"){
                    $('.lang-en #img-vi').hide();
                    $('.lang-en #img-en').show();
                }
                else{
                     $('.lang-en #img-vi').show();
                    $('.lang-en #img-en').hide();

                }
            }
         });
        
           
             
     </script>
     <div class="global-thread-create-cta">
        <a href="/en/hoibacsi/datcauhoi/" class="button">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            <strong>Ask doctor</strong>
            <span>free</span>
        </a>
    </div>
</header>
<br><br><br><br>