<?php
namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface{
    public function getAll($request);
    public function create($data);
    public function findOne($id);
    public function update($data,$id);
    public function getLastStudentNumber();
    public function addWaitingStudentToGroup($waitingStudent, $group_id);
    public function graduated();
}
