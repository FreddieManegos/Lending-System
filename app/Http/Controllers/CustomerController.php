<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use PDF;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function export_pdf(Request $request)
    {
        $data = Loan::where('id',$request->route('id'))->get();
        if($data->first()->is_paid == 0) {
            $pdf = PDF::loadView('customer.pdf', compact('data'))->setPaper('Letter', 'Portrait');
            Storage::put('public/pdf/' . $request->route('id') . '_collector_' . Carbon::today()->toDateString() . '.pdf', $pdf->output());
            return response()->file(storage_path('app\public\pdf\\' . $request->route('id') . '_collector_' . Carbon::today()->toDateString() . '.pdf'));
        } else {
            $pdf = PDF::loadView('customer.paid_pdf', compact('data'))->setPaper('Letter', 'Portrait');
            Storage::put('public/pdf/' . $request->route('id') . '_collector_' . Carbon::today()->toDateString() . '.pdf', $pdf->output());
            return response()->file(storage_path('app\public\pdf\\' . $request->route('id') . '_collector_' . Carbon::today()->toDateString() . '.pdf'));
        }
    }

    public function view_table(){
        $data = Customer::orderBy('last_name','asc')->get()->toArray();
        return view('customer.pdf',compact('data'));
    }
}

