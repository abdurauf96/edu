<?php
$params = json_decode($transaction->detail, true)['params'];
$description = '';
$purpose = 1;
if (!isset($params['paramKey'])) {
    info($params);
    $keys = $params;
    foreach ($keys as $k) {
        if ($k['paramKey'] == 'type') {
            if ($k['paramValue'] != 'course') {
                switch ($k['paramValue']) {
                    case 'coworking':
                        $purpose = 2;
                        break;
                    case 'cybersport':
                        $purpose = 3;
                        break;
                    default:
                        $purpose = 4;
                        break;
                }
            }
        }
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