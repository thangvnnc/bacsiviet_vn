@extends('main',['title'=> 'Danh sách bệnh'])

@section('benh','active');
@section('content')
<div id="main">
			
			
<div class="container">
    <div class="row">
        <div id="page-title">
            <div class="background"></div>
            <div class="mask">
                <div class="position">
                    <ul class="breadcrumbs">
                        <li><a href="/">Trang chủ</a></li>
                        <li class="active">Bệnh</li>
                    </ul>

                    <h1>Danh sách bệnh</h1>
                </div>
            </div>
        </div>
    </div>
</div>			


<div class="position">
    <div id="disease-list">
        <div class="content">
            <section class="disease-index smooth-scroll-link">
                <h3>Tra theo bảng chữ cái</h3>

                <ul>
                    
                      @foreach(range('A','Z') as $char) 
                        <li>
                            
                                <a href="#{{$char}}" class="active">{{$char}}</a>
                            
                        </li>
                       @endforeach
                    
                      
                        
                    
                </ul>
            </section>

            <section class="disease-body collapsible-container collapsible-block">
                <h3 class="collapse-trigger">Bệnh được tìm nhiều nhất</h3>

                <ul class="collapsible-target">
                        @foreach($benh_view as $view)
                        <?php $tieude = App\Disease::to_slug($view['name']);
                                             ?>
                        <li><a href="/benh/{{$tieude}}-{{$view['disease_id']}}">{{$view->name}}</a></li>
                        @endforeach
                
                    
                </ul>
            </section>
                    

                @foreach(range('A','Z') as $char)
                    <section id="{{$char}}" class="disease-body collapsible-container collapsible-block collapsed">
                        <h3 class="collapse-trigger">{{$char}}</h3>

                        <ul class="collapsible-target">
                                <?php $benhs = App\Disease::where('disease_name','LIKE',''.$char.'%')->distinct()->get(); ?>
                                @foreach($benhs as $benh)
                              
                                 <?php $tieude = App\Disease::to_slug($benh->disease_name);
                                             ?>
                                <li><a href="/benh/{{$tieude}}-{{$benh['disease_id']}}">{{$benh->disease_name}}</a></li>
                                @endforeach
                            
                        </ul>

                        <span class="back-to-top smooth-scroll-link">
                            <a href="#main" class="active">
                                Trở về đầu trang
                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                            </a>
                        </span>
                    </section>
                @endforeach
            
                
                
            
        </div>
    </div>
</div>

			
			<input name="csrfmiddlewaretoken" value="ZPSo31DHOOuFKv1BD8gTdDyX5aUmOfmU" type="hidden">
		</div>
@endsection
