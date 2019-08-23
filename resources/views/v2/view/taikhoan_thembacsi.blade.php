@extends('v2/view/taikhoan',['title'=> 'Thêm bác sĩ'])
@section('taikhoan_content')
<div class="content-tk-home">
	<div class="cnt-tk-add-dt">
				<h1 class="h1-tk-addbs">Thêm bác sĩ</h1>
                <form class=" form-horizontal" action=" " method="post" id="contact_form" enctype="multipart/form-data">

                    <!-- Text input-->

                    <div class="form-group ">
                        <label class=" control-label">Tên bác sĩ:</label>
                        <div class=" inputGroupContainer">
                            <div class="">
                                <input name="doctorname" placeholder="tên bác sĩ" class="form-control" type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->

                    <div class="form-group ">
                        <label class=" control-label">Hình ảnh:</label>
                        <div class=" inputGroupContainer">
                            <div class="">

                                <input name="hinhanh" placeholder="" class="form-control" type="file">
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group ">
                        <label class=" control-label">Mô tả</label>
                        <div class=" inputGroupContainer">
                            <div class="">

                                <textarea name="description" placeholder="mô tả" class="form-control"
                                          type="text"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class=" control-label">Chuyên khoa</label>
                        <div class=" selectContainer">
                            <div class="">

                                <select name="chuyenkhoa[]" class="selectpicker" multiple>
                                    @if(isset($specialities))
                                        @foreach($specialities as $spec)
                                            <option value="{{$spec->speciality_id}}">{{$spec->speciality_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class=" control-label">Dịch vụ</label>
                        <div class=" selectContainer">
                            <div class="">

                                <select name="dichvu[]" class="selectpicker" multiple>
                                    @if(isset($services))
                                        @foreach($services as $ser)
                                            <option value="{{$ser->service_id}}">{{$ser->service_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group ">
                        <label class=" control-label">Kinh nghiệm</label>
                        <div class=" inputGroupContainer">
                            <div class="">

                                <input name="kinhnghiem" placeholder="các giá trị cách nhau dấu #" class="form-control"
                                       type="text" data-role="tagsinput">
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class=" control-label">Địa Chỉ</label>
                        <div class=" inputGroupContainer">
                            <div class="">
                                <select name="diachi">
                                    <?php $province = App\Province::all();
                                    $select = request()->input('province');?>

                                    <option value="">Cả nước</option>
                                    @foreach($province as $pr)
                                        <option value="{{$pr->id}}"
                                                @if($pr->id==$select)selected="selected" @endif>{{$pr->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class=" control-label">Quá trình đào tạo</label>
                        <div class=" inputGroupContainer">
                            <div class="">

                                <input name="daotao" placeholder="các giá trị cách nhau dấu #" class="form-control"
                                       type="text" data-role="tagsinput">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class=" control-label">Nơi công tác</label>
                        <div class=" inputGroupContainer">
                            <div class="">

                                <input name="noicongtac" placeholder="" class="form-control" type="text"
                                       data-role="tagsinput">
                            </div>
                        </div>
                    </div>


                    <!-- Text input-->

                    <div class="form-group ">
                        <label class=" control-label">Giờ làm việc</label>
                        <div class=" inputGroupContainer">
                            <div class="">
                                <input name="doctortimework" placeholder="giờ làm việc của bác sĩ" class="form-control"
                                       type="text">
                            </div>
                        </div>
                    </div>

                    <!-- Text input-->


                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <!-- Button -->
                    <div class="form-group">
                       
                        <div class="but-tk-addbs">
                            <button type="submit" class="btn btn-warning">Gửi <span
                                        class="glyphicon glyphicon-send"></span></button>
                        </div>
                    </div>

                </form>
            </div>
        </div><!-- /.container -->
</div>
@endsection