<?php


namespace App\Services;


use App\Exports\SchoolExport;
use Maatwebsite\Excel\Facades\Excel;

class SchoolService
{
    public function exportToExcel($schools)
    {
        $data=[]; $i=1;
        foreach ($schools as $school){
            $item['id']=$i;
            $item['district']=$school->district->name ?? null;
            $item['name']=$school->company_name;
            $item['director']=$school->director;
            $item['addres']=$school->addres;
            $item['phone']=$school->phone;
            $item['email']=$school->email;
            $item['phone']=$school->phone;
            $item['qty']=$school->computers_qty;
            array_push($data, $item);
            $i++;
        }

        return Excel::download(new SchoolExport($data), 'schools.xlsx');
    }
}
