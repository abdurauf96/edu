<?php


namespace App\Repositories\Interfaces;


interface TeacherRepositoryInterface
{
    public function store($data);
    public function update($id, $data);
}
