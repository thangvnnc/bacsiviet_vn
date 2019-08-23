@extends('v2/structor/main',['title'=> 'Bác sĩ'])

<section class="section-top">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>&nbsp;>&nbsp;</li>
                    <li>Doctors</li>
                </ol>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h1 class="title">Find a Doctor</h1>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row search-group">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <h4>Search by Specialty*</h4>
                <select class="form-control">
                    <option>All specialties</option>
                    <option>Anaesthesiology (operative care &amp; pain management)</option>
                </select>
            </div>
            <div class="col-md-4">
                <h4>Search by Doctor's Name</h4>
                <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><span class="fa fa-search form-control-feedback"></span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="row result-header">
                <div class="col-md-3"><h4>Search Results</h4></div>
                <div class="col-md-6"></div>
                <div class="col-md-3"><h4>1 result(s) found</h4></div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row doctor-card">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <img src="public/v2/img/doctor.png" alt="Card image cap">
            </div>
            <div class="col-md-7">
                <h4>BÁC SĨ CK II NGUYỄN ĐÌNH TRƯỜNG</h4>
                <div class="row">
                    <div class="col-md-3 title-field">Địa Chỉ:&nbsp;</div>
                    <div class="col-md-9"><a href="/danh-sach/bac-si/?q=Hà Nội&amp;key=city">Hà Nội</a></div>
                    <div class="col-md-3 title-field">Nơi Công Tác:&nbsp;</div>
                    <div class="col-md-9">Phó trưởng khoa phụ trách khoa TMH bệnh viện 19-8 Bộ Công An</div>
                    <div class="col-md-3 title-field">Mô tả:&nbsp;</div>
                    <div class="col-md-9">Chuyên khoa Tai mũi họng, khám - tư vấn - điều trị nội khoa và phẫu thuật các
                        bệnh lý Tai mũi họng và đầu cổ tại Phó trưởng khoa phụ trách khoa TMH bệnh viện 19-8 Bộ Công An
                        Chuyên khoa Tai mũi họng, khám - tư vấn - điều trị nội khoa và phẫu thuật các bệnh lý Tai mũi
                        họng và đầu cổ tại Phó trưởng khoa phụ trách khoa TMH bệnh viện
                    </div>
                    <div class="col-md-3 title-field"></div>
                    <div class="col-md-9">
                        <a class="readmore" href="/danh-sach/bac-si/bac-si-ck-ii-nguyen-dinh-truong-65751/tai-mui-hong">Xem
                            tiếp <i class="fa fa-angle-double-right"></i></a>
                    </div>
                    <div class="col-md-3 title-field"></div>
                    <div class="col-md-9">

                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row doctor-card">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <img src="public/v2/img/doctor.png" alt="Card image cap">
            </div>
            <div class="col-md-7">
                <h4>BÁC SĨ CK II NGUYỄN ĐÌNH TRƯỜNG</h4>
                <div class="row">
                    <div class="col-md-3 title-field">Địa Chỉ:&nbsp;</div>
                    <div class="col-md-9"><a href="/danh-sach/bac-si/?q=Hà Nội&amp;key=city">Hà Nội</a></div>
                    <div class="col-md-3 title-field">Nơi Công Tác:&nbsp;</div>
                    <div class="col-md-9">Phó trưởng khoa phụ trách khoa TMH bệnh viện 19-8 Bộ Công An</div>
                    <div class="col-md-3 title-field">Mô tả:&nbsp;</div>
                    <div class="col-md-9">Chuyên khoa Tai mũi họng, khám - tư vấn - điều trị nội khoa và phẫu thuật các
                        bệnh lý Tai mũi họng và đầu cổ tại Phó trưởng khoa phụ trách khoa TMH bệnh viện 19-8 Bộ Công An
                        Chuyên khoa Tai mũi họng, khám - tư vấn - điều trị nội khoa và phẫu thuật các bệnh lý Tai mũi
                        họng và đầu cổ tại Phó trưởng khoa phụ trách khoa TMH bệnh viện
                    </div>
                    <div class="col-md-3 title-field"></div>
                    <div class="col-md-9">
                        <a class="readmore" href="/danh-sach/bac-si/bac-si-ck-ii-nguyen-dinh-truong-65751/tai-mui-hong">Xem
                            tiếp <i class="fa fa-angle-double-right"></i></a>
                    </div>
                    <div class="col-md-3 title-field"></div>
                    <div class="col-md-9">

                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row doctor-card">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <img src="public/v2/img/doctor.png" alt="Card image cap">
            </div>
            <div class="col-md-7">
                <h4>BÁC SĨ CK II NGUYỄN ĐÌNH TRƯỜNG</h4>
                <div class="row">
                    <div class="col-md-3 title-field">Địa Chỉ:&nbsp;</div>
                    <div class="col-md-9"><a href="/danh-sach/bac-si/?q=Hà Nội&amp;key=city">Hà Nội</a></div>
                    <div class="col-md-3 title-field">Nơi Công Tác:&nbsp;</div>
                    <div class="col-md-9">Phó trưởng khoa phụ trách khoa TMH bệnh viện 19-8 Bộ Công An</div>
                    <div class="col-md-3 title-field">Mô tả:&nbsp;</div>
                    <div class="col-md-9">Chuyên khoa Tai mũi họng, khám - tư vấn - điều trị nội khoa và phẫu thuật các
                        bệnh lý Tai mũi họng và đầu cổ tại Phó trưởng khoa phụ trách khoa TMH bệnh viện 19-8 Bộ Công An
                        Chuyên khoa Tai mũi họng, khám - tư vấn - điều trị nội khoa và phẫu thuật các bệnh lý Tai mũi
                        họng và đầu cổ tại Phó trưởng khoa phụ trách khoa TMH bệnh viện
                    </div>
                    <div class="col-md-3 title-field"></div>
                    <div class="col-md-9">
                        <a class="readmore" href="/danh-sach/bac-si/bac-si-ck-ii-nguyen-dinh-truong-65751/tai-mui-hong">Xem
                            tiếp <i class="fa fa-angle-double-right"></i></a>
                    </div>
                    <div class="col-md-3 title-field"></div>
                    <div class="col-md-9">

                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>
