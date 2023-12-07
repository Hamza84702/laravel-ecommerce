<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::query()->paginate(6)->withQueryString();
        return view('frontend.index',compact('products'));
    }

    public function productdetails(request $request)
    {
        $id=$request->id;
        $productdetail=Product::where('id',$id)->first();
        return view('frontend.productdetails',compact('productdetail'));
    }


   public function orders_history()
   {
        
        if(Auth::id())
        {
            $userId = Auth::user()->id;
            $orders = Order::where('user_id',$userId )->get();
            return view('frontend.order_history',compact('orders'));
        }
        else
        {
            return redirect()->route('login');
        }
      
   }

   public function cancel_order($id)
   {
        $order = Order::find($id);
        if($order)
        {
            $order->delivery_status = "Cancel";
            $order->save();
            return redirect()->back()->with('message','Your Order is Cancelled');
        }
        else
        {
            return redirect()->back()->with('message','Order Not Found');
        }
   }

}
