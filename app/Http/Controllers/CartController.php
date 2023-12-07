<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_cart(request $request, $id)
    {

        if(Auth::id())
        {
            $auth = Auth::user();
            $product = Product::where('id',$id)->first();
            $product_id_exist = Cart::where('product_id',$id)->where('user_id',$auth->id)->get('id')->first();
            if($product_id_exist)
            {
                $cart = Cart::find($product_id_exist)->first();
                $old_quantity = $cart->quantity;
                $new_quantity = $cart->quantity + $request->quantity;
                $data = array(
                    'quantity' =>$new_quantity,
                    'price' => $product->price *  $new_quantity  - $product->discount_price * $new_quantity,
                );
                $cart->update($data);
                $cartCount = Cart::where('user_id',$auth->id)->sum('quantity');
                session()->put('cartCount', $cartCount);
                Alert::success('Product Added Successfuly','We have added product in the cart');
                return redirect()->back();

            }
            else
            {
                $data = array(
                
                    'name'=>$auth->name,
                    'email'=>$auth->email,
                    'phone'=>$auth->phone,
                    'address'=>$auth->address,
                    'product_title'=>$product->title,
                    'price'=>$product->price *  $request->quantity - $product->discount_price * $request->quantity,
                    'quantity'=>$request->quantity,
                    'image'=>$product->image,
                    'product_id'=>$product->id,
                    'user_id'=>$auth->id,
                    'unit_price'=>$product->price,
                );
    
                $cart=Cart::create($data);
                $auth=Auth::user();
                $cartCount = Cart::where('user_id',$auth->id)->sum('quantity');
                session()->put('cartCount', $cartCount);
                Alert::success('Product Added Successfuly','We have added product in the cart');
                return redirect()->back();
            }
            //to update the cart count
           
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function show_cart()
    {
        if(Auth::user())
        {
            $id= Auth::user()->id;
            $carts=Cart::where('user_id',$id)->get();
            return view('frontend.cart',compact('carts'));
        }
        else
        {
            return redirect()->route('login');
        }

    }

    public function cart_delete($id)
    {
        $userId=Auth::user()->id;
        $cart = Cart::find($id);
        $cart->delete();
        Alert::success('Product Deleted Successfuly','Product removed from your cart');
         //to update the cart count
         $cartCount = Cart::where('user_id',$userId)->sum('quantity');
         session()->put('cartCount', $cartCount);
        return redirect()->back();
    }

    //update cart
    public function updateCart(Request $request)
    {
   
        $cartid = $request->input('productId');
        $quantity = $request->input('quantity');
        $totalPrice = $request->input('totalPrice');
        $cart=Cart::find($cartid);
        if($cart)
        {
            $data =[
                'quantity'=>$quantity,
                'price'=>$totalPrice,
            ];
            $cart->update($data);
            return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Cart not updated']);

        }
    
    }


}
