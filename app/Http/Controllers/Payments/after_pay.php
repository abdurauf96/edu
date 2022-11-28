<?php
$service_id = $transaction->detail['serviceId'] ?? 100;
$params = $transaction->detail['params'];
$description = '';
$purpose = 1;
// 100 - course - 1
// 101 - cybersport - 3
// 102 - coworking - 2
// 103 - conference room - 4

//create loop for service id
switch ($service_id) {
    case 100:
        $description = 'Оплата курса';
        $purpose = 1;
        break;
    case 101:
        $description = 'Оплата спортивного клуба';
        $purpose = 3;
        break;
    case 102:
        $description = 'Оплата коворкинга';
        $purpose = 2;
        break;
    case 103:
        $description = 'Оплата конференц-зала';
        $purpose = 4;
        break;
    default:
        $description = 'Оплата курса';
        $purpose = 1;
        break;
}

if (!isset($params['paramKey'])) {
    info($params);
    $keys = $params;
    foreach ($keys as $k) {
        if ($k['paramKey'] == 'description') {
            $description = $k['paramValue'];
        }
    }
}
$amount=$transaction->payment_system =='paynet' ? $transaction->amount/100 : $transaction->amount;
$student = \App\Models\Student::findOrFail($transaction->transactionable_id);
$student->debt-=$amount;
$student->save();
$data = [];
$data['student_id'] = $student->id;
$data['amount'] =  $amount;
$data['course_id'] = ($purpose == 1) ? $student->group->course_id : null;
$data['school_id'] = $student->school_id;
$data['purpose'] = $purpose;
$data['description'] = $description;
$data['type'] = $transaction->payment_system;
\App\Models\Payment::create($data);
