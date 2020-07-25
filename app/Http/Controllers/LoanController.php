<?php

namespace App\Http\Controllers;

use App\Collector;
use App\Customer;
use App\Loan;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

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
        $collectors = Collector::all();
        return view('loan.index',compact('not_paid_loans','paid_loans','overdue_loans','collectors'));
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

            if($request->loan_term == 52 ) {
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
            } else if($request->loan_term == 26){
                for ($i = 1; $i <= 30; $i++) {
                    $date = date("Y-m-d", strtotime($request->date_loaned . "+$i day"));
                    Payment::create([
                        'loan_id' => $loan_id,
                        'date' => $date,
                        'payment_amount' => $request->daily_payment,
                        'status' => 0,
                        'if_sunday' => date("w", (strtotime($date))) == 0 ? 1 : 0,
                    ]);
                }
            } else {
                for ($i = 1; $i <= 60; $i++) {
                    $date = date("Y-m-d", strtotime($request->date_loaned . "+$i day"));
                    Payment::create([
                        'loan_id' => $loan_id,
                        'date' => $date,
                        'payment_amount' => $request->daily_payment,
                        'status' => 0,
                        'if_sunday' => date("w", (strtotime($date))) == 0 || date("w", (strtotime($date))) == 6 ? 1 : 0,
                    ]);
                }
            }
            return redirect()->away('customer/pdf/'.$loan_id);

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
        $collectors = Collector::all();
        return view('loan.show',compact('loan','payments','collectors'));
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
       Loan::where('id',$loan->id)->update(['collector_id'=>$request->collector_id]);
       Customer::where('id', $loan->customer_id)->update($request->only(['first_name','last_name','address','mobile_no']));
       return redirect()->back()->with('message', 'Successfully updated!');
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

    public function reloan(Request $request){

        Loan::where('id',$request->original_id)->update(['is_paid' => 1]);

        $check = 0;

        $check_customers = Customer::where([
            ['first_name', '=', $request->reloan_first_name],
            ['last_name','=', $request->reloan_last_name]
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
                $customer_id = Customer::create([
                    'first_name' => $request->reloan_first_name,
                    'last_name'  => $request->reloan_last_name,
                    'address'    => $request->reloan_address,
                    'mobile_no'  => $request->reloan_mobile_no
                ])->id;
            } else {
                $customer_id = $check_customers->id;
            }
            $loan_id = Loan::create([
                'account_no' => 01,
                'collector_id' => $request->reloan_collector_id,
                'total_loan' => $request->reloan_total_loan,
                'balance' => $request->reloan_total_loan,
                'date_loaned' => $request->reloan_date_loaned,
                'customer_id' => $customer_id,
                'amount_loaned' => $request->reloan_amount_loaned,
                'due_date' => $request->reloan_due_date,
                'daily_payment' => $request->reloan_daily_payment,
                'loan_term' => $request->reloan_loan_term
            ])->id;

            if($request->loan_term == 52 ) {
                for ($i = 1; $i <= 60; $i++) {
                    $date = date("Y-m-d", strtotime($request->reloan_date_loaned . "+$i day"));
                    Payment::create([
                        'loan_id' => $loan_id,
                        'date' => $date,
                        'payment_amount' => $request->reloan_daily_payment,
                        'status' => 0,
                        'if_sunday' => date("w", (strtotime($date))) == 0 ? 1 : 0,
                    ]);
                }
            } else if($request->loan_term == 26){
                for ($i = 1; $i <= 30; $i++) {
                    $date = date("Y-m-d", strtotime($request->reloan_date_loaned . "+$i day"));
                    Payment::create([
                        'loan_id' => $loan_id,
                        'date' => $date,
                        'payment_amount' => $request->reloan_daily_payment,
                        'status' => 0,
                        'if_sunday' => date("w", (strtotime($date))) == 0 ? 1 : 0,
                    ]);
                }
            } else {
                for ($i = 1; $i <= 60; $i++) {
                    $date = date("Y-m-d", strtotime($request->reloan_date_loaned . "+$i day"));
                    Payment::create([
                        'loan_id' => $loan_id,
                        'date' => $date,
                        'payment_amount' => $request->reloan_daily_payment,
                        'status' => 0,
                        'if_sunday' => date("w", (strtotime($date))) == 0 || date("w", (strtotime($date))) == 6 ? 1 : 0,
                    ]);
                }
            }
            return redirect()->back()->with('message', 'Successfully added!');
        }

    }

    public function export_pdf($id)
    {
        $data = Loan::where('id',$id)->get();
        if($data->first()->is_paid == 0) {
            $pdf = PDF::loadView('customer.pdf', compact('data'))->setPaper('Letter', 'Portrait');
            Storage::put('public/pdf/' . $id . '_collector_' . \Illuminate\Support\Carbon::today()->toDateString() . '.pdf', $pdf->output());
            return response()->file(storage_path('app\public\pdf\\' . $id . '_collector_' . Carbon::today()->toDateString() . '.pdf'));
        } else {
            $pdf = PDF::loadView('customer.paid_pdf', compact('data'))->setPaper('Letter', 'Portrait');
            Storage::put('public/pdf/' . $id . '_collector_' . Carbon::today()->toDateString() . '.pdf', $pdf->output());
            return response()->file(storage_path('app\public\pdf\\' . $id . '_collector_' . Carbon::today()->toDateString() . '.pdf'));
        }
    }

}
