@extends('v2/view/en/en_account',['title'=> 'Remember'])
@section('en_account_content')
	<div class="content-tk-home">
		<div class="favourite-collection-detail">
		
			<section class="sec-tk-gn">
				<div class="section-header">
					<h2><i class="fa fa-user-md" aria-hidden="true"></i> The doctor remembered</h2>
				</div>
				
				<div class="section-body">

					
						<p>
							You have not memorized any doctors. As a member of ViCare, you can remember the <a style="color: #2b96cc;" href="/en/danh-sach-bac-si/"> doctors </a> you care about.
						</p>
					

					
				</div>
			</section>
		

		
			<section class="sec-tk-gn">
				<div class="section-header">
					<h2><i class="fa fa-hospital-o" aria-hidden="true"></i> Medical facilities have memorized</h2>
				</div>
				<div class="section-body">
					

					
						<p>
							You have not memorized any medical facilities. As a member of ViCare, you can remember the <a style="color: #2b96cc;" href="/en/danhsach-phongkham/"> clinic </a> that interest you.
						</p>
					

					
				</div>
			</section>
		
		</div>
	</div>
@endsection