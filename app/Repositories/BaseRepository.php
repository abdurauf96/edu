<?php

namespace App\Repositories;
use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface{
    public function createQRCode($name, $phone, $filename, $payments_str=null)
    {
        if($payments_str!=null){
            $qrcode_info=<<<TEXT
            Ismi: {$name};
            Telefon raqami: {$phone};
            To'lovlari: {$payments_str};
TEXT;
        }else{
            $qrcode_info=<<<TEXT
            O`quvchi:
            Ismi: {$name},
            Telefon raqami: {$phone},
TEXT;
        }
        \QrCode::size(100)
        ->format('png')
        ->generate($qrcode_info, public_path('admin/images/qrcodes/'.$filename));
    }
}