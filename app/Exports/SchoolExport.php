<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class SchoolExport implements FromArray, WithHeadings
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
            'Xudud',
            'Markaz',
            'Direktor',
            'Manzil',
            'Telefon',
            'E-mail',
            'Kompyuterlar soni',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

//                $event->sheet->getDelegate()->getStyle('A1:I1')
//                    ->getFill()
//                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//                    ->getStartColor()
//                    ->setARGB('EEEEEE');
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(100);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(100);
            },
        ];
    }
}
