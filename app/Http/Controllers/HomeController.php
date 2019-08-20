<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Loan;
use App\Customer;
use App\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loans_num = Loan::all()->count();
        $customers_num = Customer::all()->count();
        $overdue_customers =  Loan::where([['due_date', '<=',Carbon::today()],['is_paid','=',0]])->paginate(4);
        $overdue_num = Loan::where([['due_date', '<=',Carbon::today()],['is_paid','=',0]])->count();

        return view('dashboard', compact('loans_num', 'customers_num', 'overdue_num','overdue_customers'));
    }


    public function sales_report(Request $request)
    {
        $labels = [];
        $series = [];
        $total = 0;

        $date = date('Y-m-d', strtotime("-6 day"));
        $end_date = date('Y-m-d');

        while (strtotime($date) <= strtotime($end_date)) {

            $sales = Payment::where('status', 1)
                ->whereDate('updated_at', $date)
                ->sum('payment_amount');

            array_push($series, (int)$sales);
            array_push($labels, date('m/d', strtotime($date)));
            $total += (int)$sales;
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

        return response()->json(array(
            'labels' => $labels,
            'total' => $total,
            'series' => $series
        ));
    }

}
