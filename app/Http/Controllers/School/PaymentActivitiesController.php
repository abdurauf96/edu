<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PaymentActivity;
use Illuminate\Http\Request;

class PaymentActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $paymentActivities = PaymentActivity::latest()->paginate(12);
        return view('school.payment-activities.index', compact('paymentActivities'));
    }
}
