@extends('main',['title'=> 'Nạp tiền'])

@section('content')
<div id="main">
    <div id="account" class="has-aside">
        <div id="page-title">
            <div class="background"></div>
            <div class="mask">
                <div class="position">
                    <ul class="breadcrumbs">
                        <li>
                            <a href="/">Trang chủ</a>
                        </li>
                        <li>
                            <a href="/tai-khoan/">Quản lý tài khoản</a>
                        </li>
                    </ul>
                    <h1>
                            Thông tin tài khoản
                    </h1>
                </div>
            </div>
        </div>
        <div class="position">
            <aside>
                <section class="collapsible-container collapsible-list">
                    <h3>Xin chào, {{Session::get('user')->fullname}}</h3>

                    <dl>
                        <dt>
                            <a href="/tai-khoan/" class="active"><i class="fa fa-fw fa-user" aria-hidden="true"></i> Thông tin tài khoản</a>
                        </dt>
                        
                        <dt>
                            <a href="/tai-khoan/ghi-nho/" class=""><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> Đã ghi nhớ (0)</a>
                        </dt>
                        <dt>
                            <a href="/tai-khoan/nhan-xet/" class=""><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Nhận xét đã gửi</a>
                        </dt>
                        <dt>
                            <a href="/tai-khoan/hoi-dap/" class=""><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Hỏi đáp của tôi</a>
                        </dt>
                        <dt>
                            <a href="/tai-khoan/doi-mat-khau/" class=""><i class="fa fa-fw fa-key" aria-hidden="true"></i> Đổi mật khẩu</a>
                        </dt>
                        @if(Session::get('user')->user_type_id==0)
                        <dt>
                            <a href="/tai-khoan/them-bac-si" ><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Thêm bác sĩ</a>
                        </dt>
                        <dt>
                            <a href="/tai-khoan/them-csyt" ><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Thêm csyt</a>
                        </dt>
                        @endif
                        @if(Session::get('user')->user_type_id==2)
                        <dt>
                            <a href="/tai-khoan/viet-bai" ><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Gửi bài viết</a>
                        </dt>
                        @endif
                        <dt>
                            <a href="/dang-xuat" class="logout" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-fw fa-power-off" aria-hidden="true"></i> Đăng xuất</a>
                        </dt>

                    </dl>
                </section>
            </aside>
            <aside style="max-width: 70%">
                <h3>Đã hủy đơn hàng: <strong>{{$orderid}}</strong></h3>
            </aside>
        </div>
    </div>
    <input type="hidden" name="csrfmiddlewaretoken" value="gbuq7WSx8WlnCDBnDiNS8NPgizVPFAgG">
</div>
    <form id="frm-logout" action="/dang-xuat" method="POST" style="display: none;">
            {{ csrf_field() }}
    </form>
@endsection
