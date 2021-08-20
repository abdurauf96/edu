<?php
namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface{
    public function getAll();
    public function create($data);
    public function findOne($id);
    public function update($data,$id);
    public function generateIdNumber($student, $group_id);
    public function generatePassword($student);
    public function getLastStudent();
    public function addWaitingStudentToGroup($waitingStudent, $group_id);
}
