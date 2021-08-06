<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentController extends BaseController
{
    public $paymentRepo;

    public function __construct(PaymentRepositoryInterface $paymentRepo)
    {
        $this->paymentRepo=$paymentRepo;
    }

    public function paymentStatistics($year,$month)
    {
        $data=$this->paymentRepo->getPaymentResultsByMonth($year, $month);
        return $this->sendResponse($data);
    }
}
