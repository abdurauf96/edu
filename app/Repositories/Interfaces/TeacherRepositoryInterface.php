<?php


namespace App\Repositories\Interfaces;


interface TeacherRepositoryInterface
{
    public function getAll();
    public function findOne($id);
    public function store($data);
    public function update($id, $data);
    public function numberActives();
}
