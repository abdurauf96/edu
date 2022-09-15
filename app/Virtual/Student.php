<?php
namespace App\Virtual;
/**
 * @OA\Schema(
 *     @OA\Xml(name="Student"),
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="phone", type="string"),
 *     @OA\Property(property="year", type="string"),
 *     @OA\Property(property="address", type="string"),
 *     @OA\Property(property="passport", type="string"),
 *     @OA\Property(property="status", type="integer"),
 *     @OA\Property(property="sex", type="string"),
 *     @OA\Property(property="study_type", type="integer"),
 *     @OA\Property(property="course", type="string"),
 *     @OA\Property(property="course_plans", ref="#/components/schemas/CoursePlan"),
 *     @OA\Property(property="group", type="string"),
 *     @OA\Property(property="image", type="string"),
 *     @OA\Property(property="course-time", type="string"),
 *     @OA\Property(property="payment", type="boolean"),
 *     @OA\Property(property="qrcode_image", type="string"),
 * )
 *
 */

class Student {

}
