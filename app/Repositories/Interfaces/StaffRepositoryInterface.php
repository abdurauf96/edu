<?php

namespace App\Repositories\Interfaces;

interface StaffRepositoryInterface{
    public function store($data);
    public function update($data, $id);
}