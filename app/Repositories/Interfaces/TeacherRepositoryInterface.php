<?php


namespace App\Repositories\Interfaces;


interface TeacherRepositoryInterface
{
    public function getAll($key);
    public function findOne($id);
    public function store($data);
    public function update($id, $data);
}
