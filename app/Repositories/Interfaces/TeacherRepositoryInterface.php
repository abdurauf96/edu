<?php


namespace App\Repositories\Interfaces;


interface TeacherRepositoryInterface
{
    public function getAll($key);
    public function findOne($id);
    public function store($data);
    public function update($id, $data);
    public function storeSchoolTeacher($data);
    public function updateSchoolTeacher($id,$data);
    public function numberActives();
}
