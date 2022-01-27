<?php
$service_id = $transaction->detail['serviceId'] ?? 100;
$params = $transaction->detail['params'];
$description = '';
$purpose = 1;
// 100 - course - 1
// 101 - cybersport - 3
// 102 - coworking - 2
// 103 - conference room - 4
switch ($service_id) {
    case 101:
        $purpose = 3;
        break;
    case 102:
        $purpose = 2;
        break;
    case 103:
        $purpose = 4;
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
$student = \App\Models\Student::findOrFail($transaction->transactionable_id);
$data = [];
$data['student_id'] = $student->id;
$data['amount'] = $transaction->amount;
$data['course_id'] = ($purpose == 1) ? $student->group->course_id : null;
$data['school_id'] = $student->school_id;
$data['purpose'] = $purpose;
$data['description'] = $description;
$data['type'] = 'paynet';
\App\Models\Payment::create($data);