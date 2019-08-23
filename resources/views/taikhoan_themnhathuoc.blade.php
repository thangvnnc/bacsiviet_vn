@extends('taikhoan',['title'=> 'Medicalvn - Trang chủ'])

@section('taikhoan_content')

    <div class="content">

        <div id="my-threads">

            <div class="container">

                <form class=" form-horizontal" action=" " method="post" id="contact_form" enctype="multipart/form-data">

                    <!-- Text input-->

                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên nhà thuốc</label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="">
                                <input name="drugstorename" placeholder="tên nhà thuốc" class="form-control"
                                       type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->

                    <div class="form-group">
                        <label class="col-md-3 control-label">Hình ảnh:</label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="">

                                <input name="hinhanh" placeholder="" class="form-control" type="file">
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mô tả</label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="">
                                <textarea name="description" placeholder="mô tả" class="form-control"
                                          type="text"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Địa chỉ</label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="">

                                <input name="diachi" placeholder="" class="form-control" type="text"
                                       data-role="tagsinput">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tỉnh thành</label>
                        <div class="col-md-6 inputGroupContainer">

                            <select class="" name="province" id="province">
                                <?php $province = App\Province::all();?>
                                @foreach($province as $pr)
                                    <option value="{{$pr->id}}">{{$pr->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Điện thoại</label>
                        <div class="col-md-6 inputGroupContainer">
                            <div class="">

                                <input name="dienthoai" placeholder="" class="form-control" type="text"
                                       data-role="tagsinput">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning">Gửi <span
                                        class="glyphicon glyphicon-send"></span></button>
                        </div>
                    </div>

                </form>
            </div>
        </div><!-- /.container -->


    </div>

    </div>

    <script type="text/javascript">
        <!--
        $(this).addClass('active');
        //-->
    </script>

@endsection
