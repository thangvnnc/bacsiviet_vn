@extends('v2/view/en/en_account',['title'=> 'Add drugstore'])
@section('en_account_content')
<div class="content-tk-home">
	 <div class="cnt-tk-add-nt">
	 	<h1 class="h1-tk-add-nt">Thêm nhà thuốc</h1>
        <form class=" form-horizontal" action=" " method="post" id="contact_form" enctype="multipart/form-data">

            <!-- Text input-->

            <div class="form-group">
                <label class=" control-label">Tên nhà thuốc</label>
                <div class=" inputGroupContainer">
                    <div class="">
                        <input name="drugstorename" placeholder="Tên nhà thuốc" class="form-control"
                               type="text">
                    </div>
                </div>
            </div>

            <!-- Text input-->

            <div class="form-group">
                <label class=" control-label">Hình ảnh:</label>
                <div class=" inputGroupContainer">
                    <div class="">

                        <input name="hinhanh" placeholder="" class="form-control" type="file">
                    </div>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class=" control-label">Mô tả</label>
                <div class=" inputGroupContainer">
                    <div class="">
                        <textarea name="description" placeholder="mô tả" class="form-control"
                                  type="text"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label">Địa chỉ</label>
                <div class=" inputGroupContainer">
                    <div class="">

                        <input name="diachi" placeholder="" class="form-control" type="text"
                               data-role="tagsinput">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class=" control-label">Tỉnh thành</label>
                <div class=" inputGroupContainer">

                    <select class="" name="province" id="province">
                        <?php $province = App\Province::all();?>
                        @foreach($province as $pr)
                            <option value="{{$pr->id}}">{{$pr->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label">Số điện thoại</label>
                <div class=" inputGroupContainer">
                    <div class="">

                        <input name="dienthoai" placeholder="" class="form-control" type="text"
                               data-role="tagsinput">
                    </div>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <!-- Button -->
            <div class="form-group">
                
                <div class="but-add-tk-nt">
                    <button type="submit" class="btn btn-warning">Gửi <span
                                class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection