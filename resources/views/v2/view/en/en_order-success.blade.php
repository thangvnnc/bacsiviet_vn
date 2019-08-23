@extends('v2/view/en/en_main',['title'=> 'Recharge'])
@section('en_content')

<div class="main-A">
    <div id="top">
        <div class="link">
            <div class="nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>&nbsp;>&nbsp;</li>
                    <li><a href="">Account management</a></li>
                </ul>

            </div>

            <h2 style="font-size: 18px;">Deposit results</h2>
        </div>
    </div><!-- #top -->
    <div class="nl-nt-cnt">
        <aside class="as-nl-l">
            <section class="sec-acc">
                <h3>Hello, {{Session::get('user')->fullname}}</h3>

                <dl>
                    <dt>
                        <a href="/en/taikhoan/"><i class="fa fa-fw fa-user" aria-hidden="true"></i> Account infomation</a>
                    </dt>

                    <dt>
                        <a href="/en/taikhoan/ghinho/" class=" "  ><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> Remembered (0)</a>
                    </dt>
                    <dt>
                        <a href="/tai-khoan/nhan-xet/" ><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Comment sent</a>
                    </dt>
                    <dt>
                        <a href="/en/taikhoan/hoidap/" ><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> My FAQ</a>
                    </dt>
                    <dt>
                        <a href="/en/taikhoan/doimatkhau/" ><i class="fa fa-fw fa-key" aria-hidden="true"></i> Change Password</a>
                    </dt>
                    @if(Session::get('user')->user_type_id==0)
                        <dt>
                            <a href="/en/taikhoan/thembacsi/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm bác sĩ</a>
                        </dt>
                        <dt>
                            <a href="/en/taikhoan/themcsyt/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm cơ sở y tế</a>
                        </dt>
                        <dt>
                            <a href="/en/taikhoan/themnhathuoc/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm nhà thuốc</a>
                        </dt>
                    @endif
                    @if(Session::get('user')->user_type_id==2)
                        <dt>
                            <a href="/en/taikhoan/vietbai/" ><i class="fa fa-plus" aria-hidden="true"></i> Send the writing</a>
                        </dt>
                    @endif
                    <dt>
                        <a href="/en/dangxuat" class="logout" {{-- onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" --}}><i class="fa fa-fw fa-power-off" aria-hidden="true"></i> Logout</a>
                    </dt>

                </dl>
            </section>
        </aside>
        <aside class="as-nl-r">
            <h3><strong>{{$result}}</strong></h3>
        </aside>
    </div>
</div>
<input type="hidden" name="csrfmiddlewaretoken" value="gbuq7WSx8WlnCDBnDiNS8NPgizVPFAgG">
<form id="frm-logout" action="/dang-xuat" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@endsection