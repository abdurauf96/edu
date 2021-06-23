<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface{
    public function createQRCode($id, $filename);
}