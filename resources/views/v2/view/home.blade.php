@extends('v2/structor/main',['title'=> 'Trang chủ'])
@section('content')
    <section id="register" style="margin-top: -70px;">
        <div class="inner clr">
            <div class="span span2 alone @if(Session::get('user') != null) h-center @endif">
                <div class="middle-item">
                    <div><img class="center" src="public/v2/img/home_two_mobiles_en.png" alt="">
                        <p class="text-center">Một bác sĩ luôn ở bên bạn mọi lúc mọi nơi</p>
                        <div class="apps clr middle-item">
                            <a href="https://itunes.apple.com/us/app/medixlink/id1443310734?ls=1&amp;mt=8"><img
                                        src="public/v2/img/appstore.svg" alt=""></a>
                            <a href="https://play.google.com/store/apps/details?id=com.app.khambenh.bacsiviet"><img
                                        src="public/v2/img/playstore.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::get('user') == null)
                <?php $isLoginTag = false;?>
                <div class="span span2 alone pp white-bg rounded">
                    <div class="block-register">
                        <div class="group-labels clr">
                            <label class="register-tab @if($errors->has('errorReg') || session('successReg')) active @else <?php $isLoginTag = true;?> @endif"><span>Đăng ký</span></label>
                            <label class="login-tab @if($errors->has('errorlogin') || $isLoginTag) active @endif"><span>Đăng nhập</span></label>
                        </div>
                        <div class="tab-register @if($errors->has('errorReg') || session('successReg')) active @endif">
                            @if($errors->has('errorReg'))
                                <div class="alert alert-danger">
                                    {{$errors->first('errorReg')}}
                                </div>
                            @endif
                            @if (session('successReg'))
                                <div class="alert alert-success">
                                    {{session('successReg')}}
                                </div>
                            @endif
                            <form action="/v2/dang-ky" method="post" enctype="miltipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                <div class="group-input">
                                    <h3>HỌ VÀ TÊN</h3>
                                    <div>
                                        <input type="text" name="name" id="name" placeholder="Họ và tên">
                                    </div>
                                </div>
                                <div class="group-input">
                                    <h3>ĐIỆN THOẠI</h3>
                                    <div>
                                        <input type="text" name="mobile_phone" id="phone" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="group-input">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <h3>GIỚI TÍNH</h3>
                                            <select name="gender" class="form-control test" required="" id="gender"
                                                    type="text">
                                                <option value="3">Khác</option>
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <h3>LOẠI TÀI KHOẢN</h3>
                                            <select class="form-control test" name="type" required="">
                                                <option value="user" selected="selected">Thành viên</option>
                                                <option value="professional">Bác sĩ</option>
                                                <option value="place">Quản lý cơ sở y tế</option>
                                                <option value="drugstore">Nhà thuốc</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="group-input text">
                                    <h3>EMAIL ADDRESS</h3>
                                    <div>
                                        <input type="text" name="email" id="user" placeholder="Email">
                                    </div>
                                </div>
                                <div class="group-input text">
                                    <h3>PASSWORD</h3>
                                    <div>
                                        <input type="password" name="password"
                                               placeholder="Mật khẩu cần có ít nhất 5 ký tự">
                                    </div>
                                </div>

                                <br>
                                <div class="fcenter">
                                    <button type="submit" class="btn btn-ok btn-rounded" value="">ĐĂNG KÝ</button>
                                </div>

                            </form>
                        </div>
                        <div class="tab-login @if($errors->has('errorlogin') || $isLoginTag) active @endif">
                            <form method="post" action="/v2/dang-nhap" name="login">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="hidden" name="next" value="{{Request::get('next')}}"/>
                                <p>*All fields are required</p>
                                <div class="group-input">
                                    <h3>USERNAME</h3>
                                    <div>
                                        <input name="email" required="" type="text" placeholder="Tên đăng nhập">
                                    </div>
                                </div>
                                <div class="group-input">
                                    <h3>PASSWORD</h3>
                                    <div>
                                        <input name="password" required="" type="password" placeholder="Mật khẩu">
                                    </div>
                                </div>
                                {{--<div class="req"><span>Quên mật khẩu?</span> <a href="#" class="alink">Tạo lại mật khẩu</a></div>--}}
                                <div class="req">
                                    @if($errors->has('errorlogin'))
                                        <div class="form-row">
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">
                                                    &times;
                                                </button>
                                                <p style="color: #E84F5E;">{{$errors->first('errorlogin')}} </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="fcenter">
                                    <button type="submit" class="btn btn-ok btn-rounded" value="">Đăng nhập</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            @endif
        </div>
        <div id="stuffs">
            <div class="inner inner2">
                <h2 class="cat-title"><span class="title"></span></h2>
                <em>Hệ thống y tế trực tuyến tại Việt Nam với hơn 1000 bác sĩ giỏi, phòng khám tất cả các chuyên khoa và hơn 1.000.000 bệnh nhân trên toàn quốc với tất cả các chuyên khoa</em></div>
            <div class="inner">
                <div class="com-slider owl-carousel owl-theme">
                    <div class="item" data-aos="fade-in">
                        <figure><img src="public/v2/img/slider-5.jpg" alt="">
                            <figcaption>
                                <p>1. Chat text trực tiếp với bác sĩ giỏi trên App trên điện thoại mọi lúc mọi nơi</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-in">
                        <figure><img src="public/v2/img/slider-6.jpg" alt="">
                            <figcaption>
                                <p>2. Chat Audio nói chuyện trực tiếp với bác sĩ mọi lúc mọi nơi</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-in">
                        <figure><img src="public/v2/img/slider-7.jpg" alt="">
                            <figcaption>
                                <p>3. Chat Video webcam camera nói chuyện trực tiếp với bác sĩ mọi lúc mọi nơi</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="public/v2/img/slider-1.jpg" alt="">
                            <figcaption>
                                <p>4. Chức năng tra cứu thuốc, tra cứu các dược chất trong danh mục hơn 60.000 loại
                                    thuốc</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="public/v2/img/slider-2.jpg" alt="">
                            <figcaption>
                                <p>5. Tra cứu bệnh với chị tiết hơn 50.000 bệnh</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="public/v2/img/slider-3.jpg" alt="">
                            <figcaption>
                                <p>6. Danh mục hơn 1000 các bác sĩ giởi trên toàn quốc trên hệ thống</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-down">
                        <figure><img src="public/v2/img/slider-4.jpg" alt="">
                            <figcaption>
                                <p>7. Gởi câu hởi trực tiếp trên web</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="inner inner2">
                <div class="block-stuffs clr">
                    <div class="span span2 m alone">
                        <a href="/bai-viet">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-1.svg" alt=""></figure>
                                <div class="info">
                                    <h3>TIN TỨC</h3>
                                    <p class="fs">Một loạt các tin tức và bài báo y tế</p>
                                </div>
                            </div>
                        </a>
                        <a href="/bai-viet/danh-sach-nha-thuoc">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-3.svg" alt=""></figure>
                                <div class="info">
                                    <h3>DANH MỤC NHÀ THUỐC</h3>
                                    <p class="fs">Hơn 50.000 nhà thuốc trên toàn quốc</p>
                                </div>
                            </div>
                        </a>
                        <a href="/thuoc">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-5.svg" alt=""></figure>
                                <div class="info">
                                    <h3>TRA CỨU THUỐC</h3>
                                    <p class="fs">Thông tin hơn 50.000 loại thuốc</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="span span2 m alone">
                        <a href="/benh">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-2.svg" alt=""></figure>
                                <div class="info">
                                    <h3>TRA CỨU BỆNH</h3>
                                    <p class="fs">Tra cứu hơn 60.000 loại bệnh</p>
                                </div>
                            </div>
                        </a>
                        <a href="/danh-sach-bac-si">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-4.svg" alt=""></figure>
                                <div class="info">
                                    <h3>DANH MỤC BÁC SĨ</h3>
                                    <p class="fs">Hơn 15.000 thông tin bác sĩ đã liên kết</p>
                                </div>
                            </div>
                        </a>
                        <a href="/danh-sach">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-7.svg" alt=""></figure>
                                <div class="info">
                                    <h3>DANH MỤC PHÒNG KHÁM</h3>
                                    <p class="fs">Hơn 10.000 phong khám và bệnh viện trên toàn quốc</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="counters">
        <div class="inner">
            <div class="has-bg clr">
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr1" data-count="10968">0</h1>
                    <em>Phòng khám</em></div>
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr2" data-count="15121">0</h1>
                    <em>Bác sĩ</em></div>
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr3" data-count="51345">0</h1>
                    <em>Nhà thuốc</em></div>
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr4" data-count="112652">0</h1>
                    <em>Bệnh nhân</em></div>
            </div>
        </div>
    </section>
    <section id="services">
        <div class="inner">
            <div class="block-services">
                <div class="v-list" data-aos="fade-up">
                    <h2 class="heading">Các dịch vụ</h2>
                    <ul class="ful">
                        <li><a href="#" class="fs1">Tình huống phẩn cấp</a></li>
                        <li><a href="#" class="fs1">Sức khỏe hành vi</a></li>
                        <li><a href="#" class="fs1">Sức khỏe dự phòng</a></li>
                        <li><a href="#" class="fs1">Tình huống mãn tính</a></li>
                    </ul>
                    {{--<a href="#" class="btn btn-default rounded"></a>--}}
                </div>
                <div class="h-list">
                    <h2 class="cat-title"><span class="title"></span></h2>
                    <em>Các dịch vụ hổ trợ</em>
                    <div class="sv-slider owl-carousel owl-theme">
                        <div class="item" data-aos="fade-up">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/ambulance.jpg" alt=""></figure>
                                <div class="info">
                                    <h3>Tình huống phẩn cấp</h3>
                                    <p class="fs">
                                        Khi bạn ốm và cần đi khám bác sĩ, nhóm chúng tôi luôn bên bên cạnh suốt ngày đêm. Có sẵn 24/7, các bác sĩ của chúng tôi có thể giúp bạn theo dõi cũng như đơn thuốc, nếu cần.
                                        Chúng tôi sẽ gặp rắc rối và chuẩn đoán bệnh để cảm thấy tốt hơn.
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="item" data-aos="fade-up">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/khamtainha.jpg" alt=""></figure>
                                <div class="info">
                                    <h3>Sức khỏe hành vi</h3>
                                    <p class="fs">
                                        Bác sĩ đã được kiểm chứng của chúng tôi sẽ cung cấp những hỗ trợ thân thiết bất cứ nơi nào.
                                        Về kế hoạch sức khỏe của bệnh nhân, bác sĩ của chúng tôi sẽ đưa ra pháp đồ điều trị tốt nhất
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="item" data-aos="fade-down">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/khamdinhkytongquat.jpg" alt=""></figure>
                                <div class="info">
                                    <h3>Sức khỏe dự phòng</h3>
                                    <p class="fs">
                                        Đội ngũ chăm sóc chu đáo của chúng tôi Bác sĩ với bạn để hỗ trợ các thói quen chăm sóc sức khỏe và tự chăm sóc hàng ngày của bạn.
                                        Từ ăn uống lành mạnh đến sàng lọc phòng thí nghiệm, chúng tôi tập hợp Bác sĩ đáng tin cậy với các giải pháp thực sự hoạt động trong thế giới thực.
                                        Đối với các chương trình sức khỏe được chọn, chúng tôi có thể cung cấp các chương trình và kế hoạch điều trị để giúp quản lý các vấn đề và điều kiện cụ thể.
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="item" data-aos="fade-in">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/dieuduongtainha.jpg" alt=""></figure>
                                <div class="info">
                                    <h3>Tình huống mãn tính</h3>
                                    <p class="fs">
                                        Phương pháp chăm sóc của chúng tôi mang đến cho bạn sự linh hoạt để tập trung vào sức khỏe của bạn khi nó phù hợp với bạn.
                                        Khi bạn cần quản lý một tình trạng sức khỏe đang diễn ra hoặc mãn tính, chúng tôi sẽ làm cho nó dễ dàng và chỉ cần chạm vào nút.
                                        Đối với các chương trình sức khỏe được chọn, chúng tôi có thể cung cấp các chương trình và kế hoạch điều trị để giúp quản lý các vấn đề và điều kiện cụ thể.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            setHeightEqualWidth();
            function setHeightEqualWidth() {
                let widthImage = $('.img-slider-home').width();
                let height = widthImage*1.2;
                $('.img-slider-home').css("height", height + "px");
            }
            $(window).resize(function() {
                setHeightEqualWidth();
            });
        });
    </script>
    <section id="specialists">
        <div class="inner">
            <h2 class="cat-title"><span class="title">Bác sĩ nổi bật</span></h2>
            <em style="max-width:unset;">Danh sách bác sĩ tương tác nhiều trên hệ thống</em>
            <div class="content" style="width: 100%;">
                <div class="dr-slider owl-carousel owl-theme">
                    @if(isset($doctors))
                        @foreach($doctors as $doctor)
                            <div class="item" data-aos="fade-up">
                                <figure class="hover hover-zoom"><img class="img-slider-home" style="width: 100%;" src="
                @if($doctor->profile_image == '')
                                            https://n6-img-fp.akamaized.net/free-vector/doctor-character-background_1270-84.jpg?size=338&ext=jpg
                @else
                                    {{url('public/images/doctor/'.$doctor->profile_image)}}"
                                                                      alt="{{$doctor->doctor_name}}"
                                                                      @endif title="{{$doctor->doctor_name}}">
                                    <figcaption><a href="#"></a>
                                        <span>{{$doctor->doctor_name}}</span><em>{{$doctor->doctorspeciality->speciality->speciality_name}}</em>
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                @endif
                    {{--<div class="item" data-aos="fade-up">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1541044714743-82d583a7bd64.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                    {{--<div class="item" data-aos="fade-up">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1544723495-432537d12f6c.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                    {{--<div class="item" data-aos="fade-down">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1549024080-61c44c983c91.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                    {{--<div class="item" data-aos="fade-in">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1494571180607-f17765ead771.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>
@endsection