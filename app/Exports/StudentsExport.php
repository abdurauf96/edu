<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class StudentsExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data=$data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            '№',
            'F.I.SH',
            'Guruh',
            'Kurs',
            'Telefon',
            'Tuman,Shahar',
            'Manzil',
            'Status',
            'O\'qituvchi',
            'ID',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:I1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('EEEEEE');
            },
        ];
    }
}
