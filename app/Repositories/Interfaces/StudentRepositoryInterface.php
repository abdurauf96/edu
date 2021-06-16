<?php
namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface{
    public function getAll();
    public function create($data);
    public function findOne($id);
    public function update($data,$id);
    public function removeFromGroup($group_id, $student_id);
    public function addStudentToGroup($group_id, $student_id);
}