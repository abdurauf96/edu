<?php
$params = json_decode($transaction->detail, true)['params'];
$for_course = true;
if (!isset($params['paramKey'])) {
    info($params);
    $keys = $params;
    foreach ($keys as $k) {
        if ($k['paramKey'] == 'type' && $k['paramValue'] == 'coworking') {
            $for_course = false;
        }
    }
}
$student = \App\Models\Student::findOrFail($transaction->transactionable_id);
$data = [];
$data['student_id'] = $student->id;
$data['amount'] = $transaction->amount;
$data['course_id'] = $for_course ? $student->group->course_id : null;
$data['school_id'] = $student->school_id;
$data['type'] = 'paynet';
\App\Models\Payment::create($data);