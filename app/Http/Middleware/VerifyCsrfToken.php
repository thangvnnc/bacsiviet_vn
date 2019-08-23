<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/vi-tri/get',
        '/vi-tri/set',
        '/vi-tri/timkiem',
        '/congtacvien/dangky',
        '/congtacvien/danhsach',
        '/dangnhapcongtac',
        '/dangnhapcongtac',
        '/lich-su-nap-tien',
        '/nap-tien-vao-vi',
        '/kiem-tra-vi-tien',
        '/check-account-exist',
        '/dang-nhap-mobile',
        '/times-call',
        '/times-call-v2',
        '/test-mobile',
        '/facebook-callback',
        '/apiapp',
        '/apiappfacebook',
        '/dangkyapp',
        '/infodoctor',
        '/apilistkhuyenmai',
        '/check/existphone',
        '/api/chuyen-khoa',
        '/api/danh-sach/bac-si',
        '/api/danh-sach/phong-kham',
        '/api/doi-mat-khau',
        '/api/danh-sach/tinh-thanh',
        '/api/thanh-toan-tin-nhan'
    ];
}
