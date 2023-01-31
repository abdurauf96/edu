<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Jobs\StudentGenerateContractJob;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Jobs\StudentOutedCourseJob;
use App\Jobs\StudentStartedCourseJob;
use App\Jobs\StudentFinishedCourseJob;
use App\Jobs\StudentChangeCourseJob;
use PDF;

class StudentService{

    protected $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo){
        $this->studentRepo=$studentRepo;
    }

    public function getAll(){
        return $this->studentRepo->getAll();
    }

    public function findOne($id)
    {
        return $this->studentRepo->findOne($id);
    }

    public function create($request){
        try {
            DB::transaction(function () use ($request): void {
                $student=$this->studentRepo->create($request);
                dispatch(new StudentStartedCourseJob($student));
                generateQrcode($student->id, $student->qrcode, 'student');
                $this->generateIdCard($student);
            });
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function update($request, $id)
    {
        $s=$this->studentRepo->findOne($id);
        $student=$this->studentRepo->update($request, $id);
        if($request->status==2 && $s->status!=$request->status){ //if student outed course
            dispatch(new StudentOutedCourseJob($student));
        }
    }

    public function generateIdCard($student)
    {
        $circled_image=circleImage('students',$student->image);

        if(!file_exists(public_path().'/admin/images/qrcodes/'.$student->qrcode)){
            generateQrcode($student->id, $student->qrcode, 'student');
        }
        if(makeCard($student, $circled_image, 'student')){
            $student->idcard=$student->name.'.jpg';
            $student->save();
        }
        return true;
    }

    public function delete($id)
    {
        $student = $this->studentRepo->findOne($id);
        \File::delete(public_path()."/admin/images/students/".$student->image);
        \File::delete(public_path()."/admin/images/qrcodes/".$student->qrcode);
        $student->destroy($id);
        return redirect('school/students?year='.date('Y'))->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

    public function changeGroup($request)
    {
        $student=$this->studentRepo->findOne($request->student_id);
        $new_group=\App\Models\Group::find($request->new_group_id);
        dispatch(new StudentChangeCourseJob($student,$request->start_date, $new_group->course->price));
        $student->group_id=$request->new_group_id;
        $student->save();

        $description=<<<TEXT
        {$student->name}  {$student->group->course->name} kursi {$student->group->name} guruhidan {$new_group->course->name} kursi {$new_group->name} guruhiga o'tdi
TEXT;
        \App\Models\StudentActivity::create(['student_id'=>$request->student_id, 'description'=>$description ]);

    }

    public function addWaitingStudentToGroup($waitingStudent, $request)
    {
        $student=$this->studentRepo->addWaitingStudentToGroup($waitingStudent, $request);
        dispatch(new StudentStartedCourseJob($student));
        generateQrcode($student->id, $student->qrcode, 'student');
        $this->generateIdCard($student);
    }

    public function exportDataToAcademy($students){
        $data=[]; $i=1;
        foreach ($students as $student){
            $item['N']=$i;
            $item['name']=$student->name;
            $item['group']=$student->group->name;
            $item['course']=$student->group->course->name;
            $item['phone']=$student->phone;
            $item['status']=$student->statusText();
            $item['teacher']=$student->group->teacher->name;
            $item['id']=$student->id;
            array_push($data, $item);
            $i++;
        }
        return $data;
    }

    public function getByIds($ids){
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

    public function storeMessage($data)
    {
        \App\Models\StudentMessage::create([
            'student_id'=>$data['student_id'],
            'user_id'=>auth()->guard('user')->id(),
            'message'=>$data['message']
        ]);
    }

    public function downloadContract($id)
    {
        try {
            $student = $this->findOne($id);
            //generate qrcode
            $this->generateQrcodeForContract($student->id);

            //pass variables to word template
            $this->setValuesToContract($student);

//            $domPdfPath = base_path('vendor/dompdf/dompdf');
//            \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
//            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
//
//            //Load word file
//            $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('admin/contracts/shartnoma.docx'));
//            //Save it into PDF
//            $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
//            $PDFWriter->save(public_path('admin/contracts/shartnoma.pdf'));
            return response()->download(public_path('admin/contracts/shartnoma.docx'));
        }catch (\Exception $e){
            return "Xatolik yuz berdi ".$e->getMessage();
        }
    }
    public function generateQrcodeForContract($studentId)
    {
        \QrCode::size(300)
            ->format('png')
            ->color(41,38,91)
            ->margin(5)
            ->errorCorrection('H')
            ->merge('/public/admin/images/DC.png')
            ->generate('https://eduapp.uz/school/student/'.$studentId.'/download-contract', public_path('admin/contracts/qrcode.png'));
    }
    public function setValuesToContract($student)
    {
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('admin/contracts/shablon.docx'));
        $my_template->setValue('student_id', $student->id);
        $my_template->setValue('date', $student->start_date->format('d.m.Y'));
        $my_template->setValue('addres', $student->address);
        $my_template->setValue('student_name', $student->name);
        $my_template->setValue('course', $student->course()->name);
        $my_template->setValue('duration', $student->course()->duration);
        $my_template->setValue('price', $student->course()->price);
        $my_template->setValue('passport', $student->passport);
        $my_template->setValue('phone', $student->phone);
        $my_template->setValue('price_as_text', $student->course()->price_as_text);
        $my_template->setImageValue('qrcode', array('path' => public_path('admin/contracts/qrcode.png'), 'width' => 80, 'height' => 80, 'ratio' => false));
        $my_template->saveAs(public_path('admin/contracts/shartnoma.docx'));
    }


}
