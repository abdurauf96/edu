<?php
namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface{
    public function getAll();
    public function create($data);
    public function findOne($id);
    public function update($data,$id);
    public function addWaitingStudentToGroup($waitingStudent, $group_id);
    public function getByIds($ids);
    public function countByTypes();
    public function countByCourses();
    public function countLeftThisMonth();
    public function countGoodAttandance();
    public function countBadAttandance();
    public function getLastSertificateId();
}
