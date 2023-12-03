<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function updateStatus(Request $request, Payment $payment): RedirectResponse
    {
        $request->validate(['status' => 'required']);
        $payment->update(['status' => $request->status]);
        return redirect()->route('admin.payments.index')->with('success', 'Payment status updated successfully.');
    }
}
