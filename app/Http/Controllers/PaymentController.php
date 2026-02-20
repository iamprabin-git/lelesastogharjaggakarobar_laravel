<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'screenshot' => 'required|image|max:2048',
        ]);

        $path = $request->file('screenshot')->store('payments', 'public');

        Payment::create([
    'user_id' => $request->user()->id,
    'plan_name' => $request->plan_name,
    'amount' => $request->amount,
    'payment_method' => $request->payment_method,
    'transaction_id' => $request->transaction_id,
    'screenshot' => $path,
    'status' => 'pending',
]);


        return back()->with('success', 'Payment submitted successfully. Waiting for approval.');
    }
}
