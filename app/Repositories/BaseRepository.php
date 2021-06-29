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
        
        \QrCode::size(600)
        ->format('png')
        ->color(41,38,91)
        ->merge('/public/admin/images/dc.png')
        ->generate($qrcode_info, public_path('admin/images/qrcodes/'.$filename));
    }
}