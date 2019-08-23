@extends('taikhoan',['title'=> 'Medicalvn - Trang chủ'])

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=3x5qm534zrw8su69bml1w5qltiysdqpn92n4shuaxk4ojd7c"></script>

<script>tinymce.init({
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
@section('taikhoan_content')

<div class="content"> 
  <div id="my-threads">
   <div class="container">
    <form class=" form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-md-3 control-label">Tiêu đề bài viết:</label>  
        <div class="col-md-6 inputGroupContainer">          
            <input  name="tieude" placeholder="Tiêu đề" class="form-control"  type="text">          
        </div>
      </div>      

      <div class="form-group">
        <label class="col-md-3 control-label" >Tóm tắt</label> 
        <div class="col-md-6 inputGroupContainer"> 
            <textarea name="tomtat" placeholder="Tóm tắt" class="form-control" rows="4"></textarea>         
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label" >Hình ảnh:</label> 
        <div class="col-md-6 inputGroupContainer">         
            <input name="hinhanh" placeholder="" class="form-control"  type="file">          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-3 control-label">Nội dung</label>  
        <div class="col-md-6 inputGroupContainer">   
            <textarea name="noidung" id="content" placeholder="noi dung bai viet" class="form-control ckeditor"  type="text"></textarea>
        </div>
      </div>
      <div class="form-group"> 
        <label class="col-md-3 control-label">Chuyên mục</label>
        <div class="col-md-6 selectContainer">   
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
        <label class="col-md-3 control-label">Người viết</label>  
        <div class="col-md-6 inputGroupContainer">  
            <input name="nguoiviet" placeholder="" class="form-control" type="text">          
        </div>
      </div>

      
      <div class="form-group">
        <label class="col-md-3 control-label">Nguồn</label>  
        <div class="col-md-6 inputGroupContainer">    
            <input name="nguon" placeholder="Nguồn bài viết" class="form-control" type="text">          
        </div>
      </div>

      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
      <!-- Button -->
      <div class="form-group">        
        <label class="col-md-3 control-label"></label>
        <div class="col-md-6">
          <button type="submit" class="btn btn-warning" >Gửi <span class="glyphicon glyphicon-send"></span></button>
        </div>
      </div>

    </form>
  </div>
</div>
</div>

</div>


@endsection
