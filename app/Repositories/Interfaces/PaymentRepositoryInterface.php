<?php

namespace App\Repositories\Interfaces;


interface PaymentRepositoryInterface{
    public function getAll();
    public function create($data);
    public function findOne($id);
    public function update($request,$id);
}
