<?php

namespace App\Traits;

trait StudentContract
{
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
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('admin/contracts/shablon2.docx'));
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
