<?php

namespace App\Http\Controllers;

use App\Collector;
use App\Customer;
use App\Loan;
use App\Payment;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loans = Loan::all();
        return view('loan.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $collectors = Collector::all();
        return view('loan.create',compact('collectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id = Customer::create($request->only('first_name','last_name','address','mobile_no'))->id;
        Loan::create([
            'account_no'    => 01,
            'collector_id'  => $request->collector_id,
            'total_loan'    => $request->total_loan,
            'date_loaned'   => $request->date_loaned,
            'customer_id'   => $id,
            'amount_loaned' => $request->amount_loaned,
            'due_date'      => $request->due_date,
            'daily_payment' => $request->daily_payment,
            'loan_term'     => $request->loan_term
        ]);



        return redirect()->back()->with('message', 'Successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
        return view('loan.show',compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
