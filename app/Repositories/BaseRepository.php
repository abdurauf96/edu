<?php

namespace App\Repositories;
use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface{
    public function createQRCode($id, $filename)
    {
        $qrcode_info=<<<TEXT
        id: {$id}
        type: student
TEXT;
        
        \QrCode::size(200)
        ->format('png')
        ->merge('/public/admin/images/DC.png', .3)
        ->generate($qrcode_info, public_path('admin/images/qrcodes/'.$filename));
    }
}