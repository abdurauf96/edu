<?php
namespace App\Virtual;
/**
 * @OA\Schema(
 *     @OA\Xml(name="StudentPaymentHistory"),
 *     @OA\Property(property="payment_id", type="integer"),
 *     @OA\Property(property="course", type="string"),
 *     @OA\Property(property="amount", type="string"),
 *     @OA\Property(property="type", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="date", type="string", format="date"),
 * )
 *
 */

class StudentPaymentHistory{}
