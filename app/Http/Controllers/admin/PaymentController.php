<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use Carbon\Carbon;
use Session;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $startDateTime = $request->start_date . ' 00:00:00';
            $endDateTime = $request->end_date . ' 23:59:59';
    
            $payments = Order::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            
            session(['from3' => $request->start_date]);
            session(['to3' => $request->end_date]);
        } else {
            $startDateTime = Carbon::now()->startOfMonth()->format('Y-m-d') . ' 00:00:00';
            $endDateTime = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
    
            $payments = Order::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            
            session(['from3' => Carbon::now()->startOfMonth()->format('Y-m-d')]);
            session(['to3' => Carbon::now()->endOfMonth()->format('Y-m-d')]);
        }
        
        return view('admin.payment.payment', compact('payments'));
    }
    
}
