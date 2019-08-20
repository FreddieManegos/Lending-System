<?php

namespace App\Http\Controllers;

use App\Collector;
use App\Customer;
use App\Loan;
use App\Payment;
use Carbon\Carbon;
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
        $not_paid_loans = Loan::where('is_paid','=',0)->get();
        $paid_loans = Loan::where('is_paid','=',1)->get();
        $overdue_loans = Loan::where([['is_paid','=',0],['due_date','<=',Carbon::today()->toDateString()]])->get();
        return view('loan.index',compact('not_paid_loans','paid_loans','overdue_loans'));
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
        $check = 0;

        $check_customers = Customer::where([
            ['first_name', '=', $request->first_name],
            ['last_name','=', $request->last_name]
        ])->first();

        if($check_customers != null) {
            foreach($check_customers->loan as $loan){
                if($loan->is_paid == 0) {
                    $check = 1;
                }
            }
        }

        if($check == 1) {
            return redirect()->back()->with('warning', 'Customer previous loan might not be fully paid!');
        }else {
            if($check_customers == null){
                $customer_id = Customer::create($request->only('first_name', 'last_name', 'address', 'mobile_no'))->id;
            } else {
                $customer_id = $check_customers->id;
            }
            $loan_id = Loan::create([
                'account_no' => 01,
                'collector_id' => $request->collector_id,
                'total_loan' => $request->total_loan,
                'balance' => $request->total_loan,
                'date_loaned' => $request->date_loaned,
                'customer_id' => $customer_id,
                'amount_loaned' => $request->amount_loaned,
                'due_date' => $request->due_date,
                'daily_payment' => $request->daily_payment,
                'loan_term' => $request->loan_term
            ])->id;

            for ($i = 1; $i <= 60; $i++) {
                $date = date("Y-m-d", strtotime($request->date_loaned . "+$i day"));
                Payment::create([
                    'loan_id' => $loan_id,
                    'date' => $date,
                    'payment_amount' => $request->daily_payment,
                    'status' => 0,
                    'if_sunday' => date("w", (strtotime($date))) == 0 ? 1 : 0,
                ]);
            }

            return redirect()->back()->with('message', 'Successfully added!');
        }

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
        $payments = Payment::where([['loan_id','=',$loan->id],['if_sunday','=',0]])->orderBy('status','asc')->orderBy('id','asc')->paginate(10);
        return view('loan.show',compact('loan','payments'));
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

        $num_loans  = Loan::where('customer_id',$loan->customer->id)->count();
        Loan::destroy($loan->id);
        if($num_loans == 1) {
            Customer::destroy($loan->customer->id);
        }
        Payment::where('loan_id',$loan->id)->delete();
        return redirect()->back()->with('message', 'Successfully deleted!');
    }

    public function getLoan(Request $request){
        $loan['data'] = Loan::where('id',$request->id)->get();
        echo json_encode($loan);
        exit;
    }

    public function getNextId(){
        $nextId = Loan::max('id') + 1;
        return $nextId;
    }

}
