<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan = Loan::where('id', $request->id)->first();
        for ($i = 1; $i <= 7; $i++) {
            $date = date("Y-m-d", strtotime($loan->due_date . "+$i day"));
            Payment::create([
                'loan_id' => $loan->id,
                'date' => $date,
                'payment_amount' => $loan->daily_payment,
                'status' => 0,
                'if_sunday' => date("w", (strtotime($date))) == 0 ? 1 : 0,
            ]);
        }
        return redirect()->back()->with('message', 'Extend Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function updatePayment(Request $request){
        $payment = Payment::where('id',$request->id)->first();
        $payment->status=1;
        $payment->payment_amount = $request->daily_payment;
        $payment->save();

        $loan = Loan::where('id', $payment->loan_id)->first();
        $loan->balance -= $request->daily_payment;
        if($loan->balance == 0){
            $loan->is_paid = 1;
        }
        $loan->save();
    }

    public function updatePayment_2(Request $request){
        $payment = Payment::where('id',$request->id)->first();
        $payment['status']=0;
        $payment['payment_amount'] = $request->daily_payment;
        $payment->save();

        $loan = Loan::where('id', $payment->loan_id)->first();
        $loan['balance'] += $request->daily_payment;
        if($loan['is_paid'] == 1){
            $loan['is_paid'] = 0;
        }
        $loan->save();
    }
}
