<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\OrderConfirmation;
use App\Mail\DeliveryStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\UserCheckout;
use App\Models\Category;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Session;
use Stripe;
use File;
use PDF;

class OrderController extends Controller
{
    public function cash_order()
    {
        $user_id = Auth::user()->id;
        $data = Cart::where('user_id', $user_id)->get();
        $orders = []; // Initialize the $orders array outside the loop
    
        foreach ($data as $data) {
            $array = [
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                'user_id' => $data->user_id,
                'product_title' => $data->product_title,
                'quantity' => $data->quantity,
                'price' => $data->price,
                'image' => $data->image,
                'product_id' => $data->product_id,
                'payment_status' => 'pending',
                'delivery_status' => 'Processing',
                'payment_method' => 'cod',
            ];
            
            try {
                $order = Order::create($array);
                if ($order) {
                    $orders[] = $order; // Append each order to the $orders array
    
                    $cart_id = $data->id;
                    $cart = Cart::find($cart_id);
                    $cart->delete();
                    UserCheckout::where('user_id', $user_id)->where('cart_id', $cart_id)->delete();
                    $cartCount = Cart::where('user_id', Auth::user()->id)->sum('quantity');
                    session()->put('cartCount', $cartCount);
                }
            } catch (\Exception $e) {
                dd($e);
            }
        }
        
        // Pass the $orders array to the OrderConfirmation mail class
        $mail = new OrderConfirmation($orders);
        Mail::to(auth::user()->email)->send($mail);
    
        Alert::success('Order Placed Successfully', 'We will contact you soon');
        return redirect()->route('show_cart');
    }
    

    public function stripe_order($totalprice)
    {
        return view('frontend.stripe',compact('totalprice'));
    }


    public function stripePost(Request $request, $totalprice)
    {
        $user_name = Auth::user()->name;
        Stripe\Stripe::setApiKey('pk_test_51O3y1OAhmYjny5gH83Y2p1oQIfdRsnxCcdxJSiWLzZCp5GMOFhZfVegcgcs4OFo4Jl9hbLJNxkTkjWXmxNLochuz00MDSkn1E6');
        Stripe\Stripe::setApiKey('sk_test_51O3y1OAhmYjny5gH7MJIgqxzRuOgp1ff2xkEnLT3kU8jNpxVY2lWxZ1OGP7Rmd3GQE4pYMYmizG75DGxxgPVnuL900qAw9kZsa');
        try {
            $charge = Stripe\Charge::create ([
                    "amount" => $totalprice * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Test payment from Noorsaffron",
            ]);
            $stripeChargeId = $charge->id;
            $user_id = Auth::user()->id;
            $data = Cart::where('user_id',$user_id)->get();
            $orders = [];
            foreach($data as $data)
            {
                $array = [
                    'name'=> $data->name,
                    'email'=>$data->email,
                    'phone'=>$data->phone,
                    'address'=>$data->address,
                    'user_id'=>$data->user_id,
                    'product_title'=>$data->product_title,
                    'quantity'=>$data->quantity,
                    'price'=>$data->price,
                    'image'=>$data->image,
                    'product_id'=>$data->product_id,
                    'payment_status'=>'Paid',
                    'delivery_status'=>'Processing',
                    'payment_method'=>'online'
                ];
                $order=Order::create($array);
                $orders[] = $order;
                if($order)
                {
                    $paymentArray = [
                        'order_id' => $order->id,
                        'stripe_charge_id' => $charge->id,
                    ];
    
                    Payment::create($paymentArray);

                    $cart_id = $data->id;
                    $cart=Cart::find($cart_id);
                    $cart->delete();
                    UserCheckout::where('user_id', $user_id)->where('cart_id', $cart_id)->delete();
                    $cartCount = Cart::where('user_id',Auth::user()->id)->sum('quantity');
                    session()->put('cartCount', $cartCount);
                }
            }
            $mail = new OrderConfirmation($orders);
            Mail::to(auth::user()->email)->send($mail);
            // Session::flash('success', 'Payment successful!');
            Alert::success('Payment Paid Successfuly','We have recieved Your Order');
            return redirect()->route('show_cart');
        }
        catch (Exception $e) {
            // Handle payment failure
            \Log::error('Stripe Payment Failed: ' . $e->getMessage());

            Alert::error('Payment Failed', 'There was an error processing your payment. Please try again later or contact support.');
            return redirect()->route('show_cart');
        }
    }

    public function orders(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            // If start and end dates are provided in the request, fetch orders accordingly
            $orders = Order::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
    
            session(['from1' => $request->start_date]);
            session(['to1' => $request->end_date]);
        } else {
            // If start and end dates are not provided, create default dates
            $defaultStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $defaultEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    
            // Fetch orders for the default date range
            $orders = Order::whereBetween('created_at', [$defaultStartDate . ' 00:00:00', $defaultEndDate . ' 23:59:59'])->get();
    
            // Store default dates in the session
            session(['from1' => $defaultStartDate]);
            session(['to1' => $defaultEndDate]);
        }
    
        return view('admin.orders', compact('orders'));
    }
    
    
    
   //update the delivery status
    public function updateDeliveryStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $newStatus = $request->input('delivery_status');

        // Update the delivery status in the database
        $order = Order::find($orderId);
        if ($order) 
        {
            $updatedPaymentStatus = $order->payment_status;
            if ($newStatus == 'Deliverd' && $order->payment_method == 'cod')
            {    
                $order->delivery_status = $newStatus;
                $order->payment_status = 'Paid';
                $order->save();
                $updatedPaymentStatus = 'Paid';
            }
            elseif($newStatus == 'Cancel' && $order->payment_method == 'cod')
            {
                $order->delivery_status = $newStatus;
                $order->payment_status = 'Paid';
                $order->save();
                $updatedPaymentStatus = 'reject';
            }
            else
            {
                $order->delivery_status = $newStatus;
                $order->save();
            }
            
            $deliverystatus = new DeliveryStatusMail($order);
            mail::to($order->email)->send($deliverystatus);
            return response()->json([
                                'updatedStatus' => $newStatus,
                                'updatedPaymentStatus' => $updatedPaymentStatus,
                                'message' => 'Delivery status updated successfully']);
        } 
        else 
        {
            return response()->json(['error' => 'Order not found'], 404);
        }
    }


    //PDF Download
    public function order_pdf($id)
    {
        $currentDate = Carbon::now()->toDateString();
        $dueDate = Carbon::now()->addMonth()->toDateString();
        $order=Order::find($id);
        $pdf=PDF::loadview('admin.order_pdf',compact('order','dueDate','currentDate'));
        return $pdf->download('order_detail.pdf');
    }

    //Search Record
    public function search_order(Request $request)
    {
        $searchData = $request->search;
        $orders = Order::where('name', 'LIKE', "%$searchData%")
            ->orWhere('email', 'LIKE', "%$searchData%")
            ->orWhere('phone', 'LIKE', "%$searchData%")
            ->orWhere('Product_title', 'LIKE', "%$searchData%")
            ->orWhere('payment_status', 'LIKE', "%$searchData%")
            ->orWhere('delivery_status', 'LIKE', "%$searchData%")
            ->get();
        session::flash('searchData',$searchData);
        return view('admin.orders', compact('orders'));
    }
    

    //Generate pdf for orders List
    public function orders_list_pdf(request $request)
    {   
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!is_null($start_date) && !is_null( $end_date)) 
        {
            $orders = Order::whereBetween('created_at', [$start_date . ' 00:00:00',  $end_date . ' 23:59:59'])->get();
            session(['from1' => $request->start_date]);
            session(['to1' => $request->end_date]);
        }
        else
        {
            $start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::now()->endOfMonth()->format('Y-m-d');
            $orders = Order::whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])->get();
            session(['from1' => $start_date]);
            session(['to1' => $end_date]);
        }
            $pdf=PDF::loadview('admin.orders_list_pdf',compact('orders','start_date','end_date'));
            return $pdf->download('Orders_list.pdf');
    }

    
    //Download Orders list in Excel
    public function orders_list_Excel(request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!is_null($start_date) && !is_null( $end_date)) 
        {
            $orders = Order::whereBetween('created_at', [$start_date . ' 00:00:00',  $end_date . ' 23:59:59'])->get();
            session(['from1' => $request->start_date]);
            session(['to1' => $request->end_date]);
        }
        else
        {
            $start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
            $end_date = Carbon::now()->endOfMonth()->format('Y-m-d');
            $orders = Order::whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])->get();
            session(['from1' => $start_date]);
            session(['to1' => $end_date]);
        }
       

        $data = $orders->map(function ($order,$index)
        {
            return [
                'Sr#' => $index+1,
                'Order Date' => $order->created_at,
                'Email' => $order->email,
                'Address' => $order->address,
                'Phone'=>   $order->phone,
                'Product Name' => $order->product_title,
                'Quantity' => $order->quantity,
                'Price' => $order->price,
                'Payment Status' => $order->payment_status,
                'Delivery Status' => $order->delivery_status,
            ];
        })->toArray();

        $headings = [
            ['Sr#', 'Order Date', 'Email','Address','Phone','Product Title','Quantity',	'Price','Payment Status','Delivery Status'],
            
        ];
        // $export = new OrdersExport($data);

        // Export the data to Excel with specified headings
        return Excel::download(new OrdersExport($data, $headings), 'orders_list.xlsx');

    }
}
