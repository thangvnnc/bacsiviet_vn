@extends('taikhoan',['title'=> 'Medicalvn - Trang chủ'])

 	@section('taikhoan_content')
 		
	<div class="content">
			

<div class="favourite-collection-detail">
	
		<section>
			<div class="section-header">
				<h2><i class="fa fa-user-md" aria-hidden="true"></i> Bác sĩ đã ghi nhớ</h2>
			</div>
			
			<div class="section-body">

				
					<p>
						Bạn chưa ghi nhớ bác sĩ nào. Là thành viên của ViCare, bạn có thể ghi nhớ các <a href="/danh-sach/bac-si/">bác sĩ</a> mà mình quan tâm.
					</p>
				

				
			</div>
		</section>
	

	
		<section>
			<div class="section-header">
				<h2><i class="fa fa-hospital-o" aria-hidden="true"></i> Cơ sở y tế đã ghi nhớ</h2>
			</div>
			<div class="section-body">
				

				
					<p>
						Bạn chưa ghi nhớ cơ sở y tế nào. Là thành viên của ViCare, bạn có thể ghi nhớ các <a href="/danh-sach/">cơ sở y tế</a> mà bạn quan tâm.
					</p>
				

				
			</div>
		</section>
	
</div>


		</div>
	@endsection
