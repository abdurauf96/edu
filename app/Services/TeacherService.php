<?php


namespace App\Services;


use App\Exports\TeachersExport;
use Maatwebsite\Excel\Facades\Excel;

class TeacherService
{
    public function exportToExcel($teachers)
    {
        $data=[]; $i=1;
        foreach ($teachers as $teacher){
            $item['id']=$i;
            $item['name']=$teacher->name;
            $item['director']=$teacher->profession;
            $item['addres']=$teacher->getSchool->district->name ?? '';
            $item['company']=$teacher->getSchool->company_name;
            $item['email']=$teacher->birthday;
            $item['phone']=$teacher->phone;
            $item['qty']=$teacher->email;
            array_push($data, $item);
            $i++;
        }

        return Excel::download(new TeachersExport($data), 'teachers.xlsx');
    }
}
