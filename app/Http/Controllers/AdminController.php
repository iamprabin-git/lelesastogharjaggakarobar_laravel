<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
{
    $payments = Payment::latest()->get();
    return view('admin.dashboard', compact('payments'));
}

public function approve($id)
{
    $payment = Payment::findOrFail($id);
    $payment->status = 'approved';
    $payment->save();

    return back()->with('success', 'Payment Approved');
}


}
