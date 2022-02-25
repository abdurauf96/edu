<?php

namespace App\Repositories\Interfaces;

interface StaffRepositoryInterface{
    public function getAll();
    public function findOne($id);
    public function store($data);
    public function update($data, $id);
    public function generateIdCard($staff);
    
}