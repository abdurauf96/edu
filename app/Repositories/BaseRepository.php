<?php

namespace App\Repositories;
use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface{
    public function createQRCode($id, $filename, $type)
    {
        $qrcode_info=<<<TEXT
        id: {$id}
        type: {$type}
TEXT;
        
        \QrCode::size(600)
        ->format('png')
        ->color(41,38,91)
        ->margin(5) 
        ->errorCorrection('H')
        ->merge('/public/admin/images/DC.png', .3)
        ->generate($qrcode_info, public_path('admin/images/qrcodes/'.$filename));
    }
}