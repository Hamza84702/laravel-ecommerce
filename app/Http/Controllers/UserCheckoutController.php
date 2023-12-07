<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCheckout;
use App\Models\Cart;
use Carbon\Carbon;
use Session;

class UserCheckoutController extends Controller
{
    public function personal_info(Request $request)
    {
        $cartIds = $request->input('cart_ids');
        return view('frontend.personal_info');
    }

    public function personal_infoSave(Request $request)
    {
        $request->validate([
            'address.street' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.zip' => 'required|string|max:255',
        ]);
        
        $data = [
            'street' => $request->input('address.street'),
            'city' => $request->input('address.city'),
            'zip' => $request->input('address.zip'),
        ];
        $userId = Auth::user()->id;
        $cartdata = Cart::where('user_id', $userId)->get();
        $addressData = json_encode($data);
        $existingCartIds = UserCheckout::where('user_id', $userId)->pluck('cart_id')->toArray();
        $newCartIds = [];
    
        foreach ($cartdata as $cart) 
        {
            // Check if the cart_id already exists in UserCheckout table
            if (!in_array($cart->id, $existingCartIds)) {
                // If not, add it to the list of new cart_ids
                $newCartIds[] = $cart->id;
    
                // Create a new UserCheckout record
                UserCheckout::create([
                    'user_id' => $userId,
                    'delivery_address' => $addressData,
                    'cart_id' => $cart->id,
                ]);
            }
        }
    
        return view('frontend.payment',compact('cartdata'));
    }

    public function abondanedcheckouts(Request $request)
    {
        if($request->start_date && $request->end_date)
        {
            $abondanedCheckout = UserCheckout::whereBetween('created_at',[$request->start_date . '00:00:00', $request->end_date .'23:59:59'])->with('user')->with('cart')->get();
            session(['from2'=>$request->start_date]);
            session(['to2'=>$request->end_date]);
        }
        else
        {
            $start_date=Carbon::now()->startofMonth()->format('Y-m-d');
            $end_date=Carbon::now()->endofMonth()->format('Y-m-d');
            $abondanedCheckout = UserCheckout::whereBetween('created_at',[$start_date . '00:00:00', $end_date .'23:59:59'])->with('user')->with('cart')->get();
            session(['from2'=>$start_date]);
            session(['to2'=>$end_date]);
        }
        
        return view('admin.abondanedCheckouts.abondanedCheckouts',compact('abondanedCheckout'));
    }
    
}
