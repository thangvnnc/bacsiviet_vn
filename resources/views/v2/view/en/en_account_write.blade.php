@extends('v2/view/en/en_account',['title'=> 'Write'])
@section('en_account_content')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=3x5qm534zrw8su69bml1w5qltiysdqpn92n4shuaxk4ojd7c"></script>

<script>
  tinymce.init({
     selector: 'textarea#content',
     height: 300,
     theme: 'modern',
     plugins: [
       'advlist autolink lists link image charmap print preview hr anchor pagebreak',
       'searchreplace wordcount visualblocks visualchars code fullscreen',
       'insertdatetime media nonbreaking save table contextmenu directionality',
       'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
       ],
       toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor | backcolor',
       image_advtab: true,
       templates: [
       { title: 'Test template 1', content: 'Test 1' },
       { title: 'Test template 2', content: 'Test 2' }
       ],
       content_css: [
         '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
         '//www.tinymce.com/css/codepen.min.css'
     ]
  });
</script>
<div class="content-tk-home">
	<h1 class="h1-tk-add-bv">More posts</h1>
	<div class="cnt-tk-add-bv">
    <form class=" form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
      <div class="form-group">
        <label class=" control-label">Post title:</label>  
        <div class=" inputGroupContainer">          
            <input  name="tieude" placeholder="Tiêu đề" class="form-control"  type="text">          
        </div>
      </div>      

      <div class="form-group">
        <label class=" control-label" >Summary</label> 
        <div class=" inputGroupContainer"> 
            <textarea name="tomtat" placeholder="Tóm tắt" class="form-control" rows="4"></textarea>         
        </div>
      </div>
      <div class="form-group">
        <label class=" control-label" >Image:</label> 
        <div class=" inputGroupContainer">         
            <input name="hinhanh" placeholder="" class="form-control"  type="file">          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class=" control-label">Content</label>  
        <div class=" inputGroupContainer">   
            <textarea name="noidung" id="content" placeholder="noi dung bai viet" class="form-control ckeditor"  type="text"></textarea>
        </div>
      </div>
      <div class="form-group"> 
        <label class=" control-label">Category</label>
        <div class=" selectContainer">   
            <select name="chuyenmuc" class="form-control selectpicker" >
              @if(isset($catalogs))
              @foreach($catalogs as $catalog)
              <option value="{{$catalog->id}}" >{{$catalog->name}}</option>
              @endforeach
              @endif
            </select>          
        </div>
      </div>

      <!-- Text input-->

      <div class="form-group">
        <label class=" control-label">The writer: </label>  
        <div class=" inputGroupContainer">  
            <input name="nguoiviet" placeholder="" value="{{session()->get('user')->fullname}}" class="form-control" type="text">          
        </div>
      </div>

      
      <div class="form-group">
        <label class=" control-label">Source</label>  
        <div class=" inputGroupContainer">    
            <input name="nguon" placeholder="Source" class="form-control" type="text">          
        </div>
      </div>

      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
      <!-- Button -->
      <div class="form-group">        
       
        <div class="but-bv">
          <button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
        </div>
      </div>

    </form>
  </div>
</div>
@endsection