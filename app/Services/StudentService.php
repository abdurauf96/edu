<?php

namespace App\Services;

use App\Jobs\StudentChangeCourseJob;
use App\Jobs\StudentStartedCourseJob;
use App\Models\Group;
use App\Models\StudentMessage;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Traits\Sertificate;
use App\Traits\StudentContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StudentService
{
    use Sertificate, StudentContract;

    public function __construct(protected StudentRepositoryInterface $studentRepo) {}

    public function getAll()
    {
        return $this->studentRepo->getAll();
    }

    public function findOne($id)
    {
        return $this->studentRepo->findOne($id);
    }

    public function create($request): void
    {
        $group=Group::find($request->group_id);
        $room_capacity=$group->room->room_capacity ?? 0 ;
        if($group->students->count()>=$room_capacity){
            throw new \Exception('Guruh o`qiyotgan xonada joy mavjud emas!');
        }
        DB::transaction(function () use ($request): void {
            $student=$this->studentRepo->create($request);
            dispatch(new StudentStartedCourseJob($student, $request->first_month_debt));
            generateQrcode($student->id, $student->qrcode, 'student');
        });
    }

    public function update($request, $id): void
    {
        $student=$this->studentRepo->update($request, $id);
    }

    public function delete($id): RedirectResponse
    {
        $student = $this->studentRepo->findOne($id);
        \File::delete(public_path()."/admin/images/students/".$student->image);
        \File::delete(public_path()."/admin/images/qrcodes/".$student->qrcode);
        $student->destroy($id);
        return redirect('school/students?year='.date('Y'))->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

    public function changeGroup($request): void
    {
        $student=$this->studentRepo->findOne($request->student_id);
        $new_group=Group::find($request->new_group_id);
        dispatch(new StudentChangeCourseJob($student,$new_group));
        $student->update(['group_id'=>$request->new_group_id]);
    }

    public function addWaitingStudentToGroup($waitingStudent, $request): void
    {
        $group=Group::find($request->group_id);
        $room_capacity=$group->room->room_capacity ?? 0 ;
        if($group->students->count()>=$room_capacity){
            throw new \Exception('Guruh o`qiyotgan xonada joy mavjud emas!');
        }

        $student=$this->studentRepo->addWaitingStudentToGroup($waitingStudent, $request);
        dispatch(new StudentStartedCourseJob($student,$request->first_month_debt));
        generateQrcode($student->id, $student->qrcode, 'student');
    }

    public function exportDataToAcademy($students): array
    {
        $data=[]; $i=1;
        foreach ($students as $student){
            $item['N']=$i;
            $item['name']=$student->name;
            $item['group']=$student->group->name ?? 'belgilanmagan';
            $item['course']=$student->group->course->name ?? 'belgilanmagan';
            $item['phone']=$student->phone;
            $item['region']=$student->district->name ?? ' belgilanmagan';
            $item['addres']=$student->address;
            $item['status']=$student->statusText();
            $item['teacher']=$student->group->teacher->name ?? 'belgilanmagan ';
            $item['id']=$student->id;
            $item['start_date']=$student->group->start_date ?? 'belgilanmagan' ;
            $item['END_date']=$student->group->end_date ?? 'belgilanmagan' ;
            array_push($data, $item);
            $i++;
        }
        return $data;
    }

    public function getByIds($ids) {
        return $this->studentRepo->getByIds($ids);
    }

    public function countByTypes()
    {
        return $this->studentRepo->countByTypes();
    }

    public function countByCourses()
    {
        return $this->studentRepo->countByCourses();
    }

    public function countGoodAttandance()
    {
        return $this->studentRepo->countGoodAttandance();
    }

    public function countBadAttandance()
    {
        return $this->studentRepo->countBadAttandance();
    }

    public function countLeftThisMonth()
    {
        return $this->studentRepo->countLeftThisMonth();
    }

    public function storeMessage($data): void
    {
        StudentMessage::create([
            'student_id'=>$data['student_id'],
            'user_id'=>auth()->guard('user')->id(),
            'message'=>$data['message']
        ]);
    }
}
