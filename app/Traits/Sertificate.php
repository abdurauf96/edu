<?php

namespace App\Traits;

trait Sertificate
{
    public function generateSertificate($data)
    {
        $student=$this->studentRepo->findOne($data['student_id']);
        $course=explode('_', $data['course']);
        $course_id=$course[0];
        $course_code=$course[1];
        if(!in_array($course_id,$student->sertificates->pluck('course_id')->toArray()) ){
            $sertificateId=$this->generateId();
            $template=selectSertificateTemplate($course_code, $data['type']);
            $this->generateQrcodeForSertificate($student->id);
            generateSertificate($template, $data['name'],$data['surname'],$sertificateId, date("j M Y", strtotime($data['date'])));
            $student->sertificates()->create([
                'sertificate_id'=>$sertificateId,
                'course_id'=>$course_id,
                'type'=>$data['type'],
                'date'=>$data['date'],
                'name'=>$data['name'],
                'surname'=>$data['surname'],
            ]);
            return $sertificateId;
        }else{
            throw new \Exception("Ushbu o'quvchi uchun ushbu sertifikat berilgan, yuklab oling!");
        }
    }
    public function getLastSertificateId()
    {
        $sertificat_id=$this->studentRepo->getLastSertificateId();
        return is_null($sertificat_id) ? $sertificat_id : substr($sertificat_id,3);
    }

    public function generateId()
    {
        //A2300000
        $current_year=date('y');
        if(is_null($this->getLastSertificateId())){
            return 'A'.$current_year.'00031';
        }
        $lastNumber=intval(substr($this->getLastSertificateId(), -5));
        $incNumber=$number = str_pad($lastNumber+1, 5, 0, STR_PAD_LEFT);
        return 'A'.$current_year.$incNumber;
    }

    public function generateQrcodeForSertificate($id)
    {
        $text="https://digital-city.uz/students/".$id;

        \QrCode::size(300)
            ->format('png')
            ->color(41,38,91)
            ->margin(0)
            ->errorCorrection('H')
            ->merge('/public/admin/images/DC.png')
            ->generate($text, public_path('admin/sertificats/qrcode.png'));
    }
}
