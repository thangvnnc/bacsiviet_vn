@extends('v2/view/en/en_main',['title'=> 'Recharge'])
@section('en_content')

<div class="main-A">
	<div id="top">
        <div class="link">
            <div class="nav">
                <ul>
                    <li><a href="/en">Home</a></li>
                    <li>&nbsp;>&nbsp;</li>
                    <li><a href="#">Account management</a></li>
                </ul>

            </div>

              <h1 style="font-size: 18px;">Account information</h1>
             <div class="header ">
                <a class="button create-thread" href="/en/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                    <i class="fa fa-commenting" aria-hidden="true"></i> Ask questions for free
                </a>
               </div>

        </div>
    </div><!-- #top -->	
    <div class="nl-nt-cnt">
            <aside class="as-nl-l">
                <section class="sec-nl-l">
                    <h3>Xin chào, {{Session::get('user')->fullname}}</h3>

                    <dl>
                        <dt>
                            <a href="/en/taikhoan/" class="active"><i class="fa fa-fw fa-user" aria-hidden="true"></i> Account information</a>
                        </dt>
                        
                        <dt>
                            <a href="/en/taikhoan/ghinho/" class=""><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> Remembered (0)</a>
                        </dt>
                        <dt>
                            <a href="/en/taikhoan/nhanxet/" class=""><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Comment sent</a>
                        </dt>
                        <dt>
                            <a href="/en/taikhoan/hoidap/" class=""><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> My FAQ</a>
                        </dt>
                        <dt>
                            <a href="/en/taikhoan/doimatkhau/" class=""><i class="fa fa-fw fa-key" aria-hidden="true"></i> Change Password</a>
                        </dt>
                        @if(Session::get('user')->user_type_id==0)
                        <dt>
                            <a href="/en/taikhoan/thembacsi" ><i class="fa fa-plus" aria-hidden="true"></i> Add a doctor</a>
                        </dt>
                        <dt>
                            <a href="/en/taikhoan/themcsyt" ><i class="fa fa-plus" aria-hidden="true"></i> Add clinic</a>
                        </dt>
                        <dt>
							<a href="/en/taikhoan/themnhathuoc" ><i class="fa fa-plus" aria-hidden="true"></i> Add drugstore</a>
						</dt>
                        @endif
                        @if(Session::get('user')->user_type_id==2)
                        <dt>
                            <a href="/en/taikhoan/vietbai" ><i class="fa fa-plus" aria-hidden="true"></i> Send the writing</a>
                        </dt>
                        @endif
                        <dt>
                            <a href="/en/dangxuat" class="logout" {{-- onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" --}}><i class="fa fa-fw fa-power-off" aria-hidden="true"></i> Logout</a>
                        </dt>

                    </dl>
                </section>
            </aside>
            <aside class="as-nl-r">
              @include('v2/view/en/en_account_money')
            </aside>
        </div>
</div>
@endsection