<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
class SchoolStudentsExport implements FromArray, WithHeadings, WithEvents
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data=$data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            '№',
            'Hudud (shahar/tuman)',
            'To\'garak o\'quvchisi  F.I.SH.',
            'Maktabi',
            'Sinfi',
            'Tug\' sana',
            'Jinsi',
            'Manzili',
            'o\'qish yoki ish joyi',
            'Telefon raqami',
            'Kurs nomi',
            'O\'quv guruhi nomi',
            'O\'qituvchi',
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
