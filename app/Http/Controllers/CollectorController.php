<?php

namespace App\Http\Controllers;

use App\Collector;
use App\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Customer;
use PDF;
use Illuminate\Support\Facades\Storage;

class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collectors = Collector::all();
        return view('collector.index',compact('collectors'));
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
        //
        Collector::create($request->all());
        return redirect()->back()->with('message', 'Successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function show(Collector $collector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function edit(Collector $collector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collector $collector)
    {
        //
        Collector::where('id',$collector->id)->update(['name' => $request->name]);
        return back()->withFlashSuccess('Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collector $collector)
    {
        //
        Collector::destroy($collector->id);
        return back()->withFlashSuccess('User deleted successfully');
    }

    public function export_pdf(Request $request)
    {
        $data = Loan::where([
            ['collector_id','=',$request->route('id')],
            ['is_paid','=',0]
            ])->get();
        if(!$data->isEmpty()) {
            $pdf = PDF::loadView('collector.pdf', compact('data'))->setPaper('Folio', 'Portrait');
            Storage::put('public/pdf/' . $request->route('id') . '_collector_' . Carbon::today()->toDateString() . '.pdf', $pdf->output());
            return response()->file(storage_path('app\public\pdf\\' . $request->route('id') . '_collector_' . Carbon::today()->toDateString() . '.pdf'));
        } else {
            return back()->withFlashSuccess('Nothing to Print');
        }
    }
}
