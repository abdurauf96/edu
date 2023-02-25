<?php

if (! function_exists('generateQrcode')) {

    function generateQrcode($id, $filename, $type) {
        $qrcode_info=<<<TEXT
        id: {$id}
        type: {$type}
TEXT;

        \QrCode::size(600)
        ->format('png')
        ->color(41,38,91)
        ->margin(5)
        ->errorCorrection('H')
        ->merge('/public/admin/images/DC.png')
        ->generate($qrcode_info, public_path('admin/images/qrcodes/'.$filename));
    }
}

if(!function_exists('generatePassword')){

    function generatePassword($year)
    {
        $yearToArray=explode('-', $year);
        $reversed=array_reverse($yearToArray);
        $yearToString=implode('', $reversed);

        return bcrypt($yearToString);
    }
}

if (! function_exists('selectSertificateTemplate')) {
    function selectSertificateTemplate($course_code,$type) {
        if($course_code=='foundation'){
            return public_path('admin/sertificats/foundation.jpg');
        }
        return public_path('admin/sertificats/'.$course_code.'-'.$type.'.jpg');
    }
}

if(!function_exists('generateSertificate')){

    function generateSertificate($template,$name,$surname,$sertificateId, $date)
    {
        $image = \Image::make($template);
        $image->text($name, 1150, 1750, function($font) {
            $font->file(public_path('admin/sertificats/univia.ttf'));
            $font->size(80);
            $font->color('#1D1D1B');
        });
        $image->text($surname, 1180, 1850, function($font) {
            $font->file(public_path('admin/sertificats/univia.ttf'));
            $font->size(80);
            $font->color('#1D1D1B');
        });
        $image->text("ID ".$sertificateId, 1600, 2975, function($font) {
            $font->file(public_path('admin/sertificats/univia.ttf'));
            $font->size(50);
            $font->color('#1D1D1B');
        });
        $image->text($date, 1150, 2650 , function($font) {
            $font->file(public_path('admin/sertificats/univia.ttf'));
            $font->size(44);
            $font->color('#1D1D1B');
        });
        $image->insert(public_path('admin/sertificats/qrcode.png'), 'bottom-right', 570, 600);
        $image->save(public_path('admin/sertificats/students/'.$sertificateId.'.jpg'));
    }
}

if(!function_exists('makeCard')){

    function makeCard($model, $circled_image, $type)
    {

        $qrcode=\Image::make('admin/images/qrcodes/'.$model->qrcode)->resize(420,420);

        $card = \Image::make(public_path('admin/images/card.jpg'));

        $card->text(strtoupper($model->name), 370, 700, function($font) {
            $font->file(public_path('admin/assets/fonts/nunito-v9-latin-800.ttf'));
            $font->size(34);
            $font->color('#000f48');
            $font->align('center');
        });
        if($type=='student'){
            $card->text('ID : '.$model->id, 300, 740, function($font) {
                $font->file(public_path('admin/assets/fonts/nunito-v9-latin-600.ttf'));
                $font->size(30);
                $font->color('#041f94');
                $font->align('center');
            });
        }else{
            $card->text($model->position, 370, 740, function($font) {
                $font->file(public_path('admin/assets/fonts/nunito-v9-latin-600.ttf'));
                $font->size(30);
                $font->color('#041f94');
                $font->align('center');
            });
        }

        $card->insert($circled_image, 'top', 100, 160);
        $card->insert($qrcode, 'bottom', 100, 80);
        $card->save(public_path('admin/images/idcards/'.$model->name.'.jpg'));
        return true;
    }
}

if(!function_exists('circleImage')){

    function circleImage($type, $img=null)
    {
        if(file_exists(public_path().'/admin/images/'.$type.'/'.$img) and isset($img)){
            $filename = 'admin/images/'.$type.'/'.$img;
        }else{
            $filename = "admin/images/default-student.png";
        }

        $image_s = imagecreatefromstring(file_get_contents($filename));
        $width = imagesx($image_s);
        $height = imagesy($image_s);

        $newwidth = 450;
        $newheight = 450;

        $image = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($image, true);
        imagecopyresampled($image, $image_s, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        //create masking
        $mask = imagecreatetruecolor($newwidth, $newheight);

        $transparent = imagecolorallocate($mask, 255, 0, 0);
        imagecolortransparent($mask,$transparent);

        imagefilledellipse($mask, $newwidth/2, $newheight/2, $newwidth, $newheight, $transparent);

        $red = imagecolorallocate($mask, 0, 0, 0);
        imagecopymerge($image, $mask, 0, 0, 0, 0, $newwidth, $newheight, 100);
        imagecolortransparent($image,$red);
        imagefill($image, 0, 0, $red);

        $circled_image='admin/images/circled-images/'.time().'.png';
        imagepng($image, $circled_image);
        imagedestroy($image);
        imagedestroy($mask);
        return $circled_image;
    }
}
