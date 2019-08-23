@extends('main',['title'=> 'Voucher'])
@section('content')
<div id="main">
    <div class="position" id="list-cms">
        <div class="content">
            <ul class="cms-breadcrumb homepage-breadcrumb">
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a> \
                </li>
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="#" itemprop="url"><span itemprop="title">Voucher</span></a>
                </li>
            </ul>

            <div class="top-new">
                
                    <div>
                    	<img style="width: 100%;" src="{!!url('public/images/voucher/index.jpg')!!}">
                    </div>
                
            </div>
        </div>
    </div>
            
</div>
@endsection