<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\View\View;

class AdminPaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::all();
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment): View
    {
        return view('admin.payments.show', compact('payment'));
    }


}
