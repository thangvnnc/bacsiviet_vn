@extends('v2/structor/main',['title'=> 'Bác sĩ chi tiết'])
@section('content')
<div class="container">
	
	<div id="thread-create">
		<h3 >Hỏi bác sĩ</h3>

		<div class="des">
			<p>Vui lòng sử dụng tiếng Việt có dấu và nêu rõ câu hỏi. Các thông tin về triệu chứng, thời gian phát bệnh, quá trình khám chữa trước đây (nếu có),... sẽ rất hữu ích cho bác sĩ. Bạn cũng có thể theo dõi câu hỏi trong mục <strong>Hỏi đáp của tôi</strong> sau khi đăng nhập.</p>
		</div>

		@if($errors->has('errorMs'))
			<div class="form-row">
	            <div class="alert alert-danger">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                {{$errors->first('errorMs')}}
	            </div>
	        </div>
        @endif      
		<form name="new-question" class="question-new" action="{{url('hoibacsi/datcauhoi')}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
			<div class="form-group reset">
				<label>
					<strong>Tóm tắt câu hỏi</strong>
					<span>*</span>
				</label>

				<input name="title" placeholder="Ví dụ: Trẻ 3 tháng bị ho đã 2 tuần có sao không ?" maxlength="100" required="" type="text">
			</div>

			<p class="text-alert">Bạn có thể viết tối đa 100 kí tự.</p>

			<div class="form-group full">
				<label>
					<strong>Chi tiết câu hỏi</strong> <span>*</span>
				</label>

				<textarea name="body" placeholder="Ví dụ: Bác sĩ ơi, bé nhà em được 3 tháng tuổi. 2 tuần nay bé bị ho, sổ mũi, đôi khi có đờm. Em chưa cho bé đi khám ở đâu, mà chỉ tự dùng thuốc. Em có nên cho bé đi khám không ạ? Có thể tự chữa trị tại nhà bằng thuốc gì ạ?"></textarea>
			</div>

			<div class="form-group full more-info show">
				<label class="btn-toggle">
					<strong>Bạn có thể cung cấp thêm thông tin về bệnh nhân và câu hỏi để bác sĩ tư vấn cụ thể hơn</strong>

					<span>
						<i class="fa fa-plus" id="plus"></i>
						<i class="fa fa-minus" id="minus"></i>
					</span>
				</label>

				<div class="form-info">						
					<label><strong>Chuyên khoa:</strong></label>

						<select name="specialities" id="">						
						@if(isset($specialities))
						
						   @foreach($specialities as $sp)
							<option value="{{$sp->speciality_id}}">{{$sp->speciality_name}}</option>
							@endforeach
						@endif					
							
						</select>					
				</div>
			</div>		 	

			<div class="form-group left">
				<label><strong>Tên của bạn</strong></label>

				<input name="name" placeholder="Nhập vào tên của bạn." @if(Session::get('user')!=null) value="{{Session::get('user')->fullname}}" @endif type="text">
			</div>

			<div class="form-group right">
				<label>
					<strong>Email của bạn</strong>
					<span>*</span>
				</label>

				<input name="email" required="" @if(Session::get('user')!=null) value="{{Session::get('user')->email}}" @endif type="email">
			</div>

			<input name="user_id" @if(Session::get('user')!=null) value="{{Session::get('user')->user_id}}" @endif type="hidden">

			<button type="submit" class="btn btn-primary">Gửi câu hỏi</button>
		</form>
	</div>

</div>
@endsection