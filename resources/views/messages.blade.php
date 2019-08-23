@extends('main',['title'=> 'Trò chuyện với bác sĩ'])


@section('content')

<div class="container">
	<div id="main" class="content_body" style="margin: 40px 0; height: 100%">



		<style type="text/css">
			@media (max-width: 992px){
				.content_body{
					margin-top: 125px!important;
				}
			}

			@media (max-width: 768px){
				.content_body{
					margin-top: 65px!important;
				}
			}

		</style>

		<script src="/public/cometchat/js.php?type=core&name=embedcode" type="text/javascript"></script>
		<div id="cometchat_embed_synergy_container" style="margin:0 auto;width:1000px;height:500px;max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;" >
			<iframe style="width: 100%; height: 100%" src="/public/cometchat/cometchat_embedded.php"></iframe>
		</div>

		<!-- <div class="block-messages" style="width: 100%; height: 100%; max-width: 100%">
			hello
		</div> -->
		<!-- <div class="message">
			<div class="row">
				<div class="chat_area col-md-8">
					<div class="msg_wrapper">
							<div class="content_header">
								<h3>Conversation</h3>
							</div>
							<div class="message_container">
								<a href="/event" class="btn btn-succes send">test</a>
							</div>
							<div class="msg_send_box">
								<textarea class="form-control"></textarea>
								<span class="send_message glyphicon glyphicon-send"></span>

							</div>
					</div>
					
				</div>
				<div class="user_online col-md-4">
					<div class="user_wrapper">
						<div class="list_user_header">
						<h3> Users list</h3>
						</div>
						<div class="user_list">
							<div class="user_item">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div> -->
		<!-- <iframe width="100%" height="100%" style="min-height: 500px" src="http://localhost:81"></iframe> -->
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>

<script type="text/javascript">
	
	// var socket = io('http://localhost:3001')

	// socket.on('message:messageas', function(data){
	// 	console.log(data);
	// })

	$(function() {
        //you define socket - you can use IP
        var socket = io('http://localhost:3001');
        //you capture message data
        socket.on('message:App\\Events\\MessagesEvent', function(data){
            //you append that data to DOM, so user can see it
            // $('#data').append('<li>' + data.username + '</li>')
            alert(3)
        });
    });

</script>




 
@endsection