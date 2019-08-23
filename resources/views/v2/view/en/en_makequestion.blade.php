@extends('v2/view/en/en_main',['title'=> 'Make a question'])
@section('en_content')
<div class="container">
	
	<div id="thread-create">
		<h3 >Ask the doctor</h3>

		<div class="des">
			<p> Please use the Vietnamese accent and specify the question. Information about symptoms, time of illness, previous treatment (if any), ... will be very helpful for doctors. You can also follow the question in the <strong> My FAQ </strong> section after logging in. </p>
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
					<strong>Summary of questions</strong>
					<span>*</span>
				</label>

				<input name="title" placeholder="For example: Is it okay for 3-month-old children to have a cough for 2 weeks?" maxlength="100" required="" type="text">
			</div>

			<p class="text-alert">You can write up to 100 characters.</p>

			<div class="form-group full">
				<label>
					<strong>Question details </strong><span>*</span>
				</label>

				<textarea name="body" placeholder="Example: Doctor, my baby is 3 months old. In the past 2 weeks, he has cough, runny nose, sometimes sputum. I have not allowed my child to go to the doctor, but only take medicine. Should I let my baby go to the doctor? What medicine can I treat myself at home?"></textarea>
			</div>

			<div class="form-group full more-info show">
				<label class="btn-toggle">
					<strong>You can provide more information about patients and questions for more specific doctor advice</strong>

					<span>
						<i class="fa fa-plus" id="plus"></i>
						<i class="fa fa-minus" id="minus"></i>
					</span>
				</label>

				<div class="form-info">						
					<label><strong>Specialist:</strong></label>

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
				<label><strong>Your name</strong></label>

				<input name="name" placeholder="Input your name." @if(Session::get('user')!=null) value="{{Session::get('user')->fullname}}" @endif type="text">
			</div>

			<div class="form-group right">
				<label>
					<strong>Your email</strong>
					<span>*</span>
				</label>

				<input name="email" required="" @if(Session::get('user')!=null) value="{{Session::get('user')->email}}" @endif type="email">
			</div>

			<input name="user_id" @if(Session::get('user')!=null) value="{{Session::get('user')->user_id}}" @endif type="hidden">

			<button type="submit" class="btn btn-primary">Send questions</button>
		</form>
	</div>

</div>
@endsection