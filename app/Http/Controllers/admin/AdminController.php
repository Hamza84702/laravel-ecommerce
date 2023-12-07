<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == '1')
        {
            $totalproducts = Product::all()->count();
            $totalorders = Order::all()->count();
            $totalcustomers = User::Where('usertype','0')->get()->count();
            $deliveredOrders = Order::Where('delivery_status','Deliverd')->count();
            $processingorders = Order::Where('delivery_status','Processing')->count();
            $dispatchgorders = Order::Where('delivery_status','Dispatch')->count();
            $deliveredPercentage = number_format(($deliveredOrders / $totalorders) * 100);
            $processingPercentage = number_format(($processingorders / $totalorders) * 100);
            $dispatchPercentage = number_format(($dispatchgorders / $totalorders) * 100);
            $orders=Order::all();
            $total_revenue = Order::sum('Price');
           
            return view('admin.home',compact('totalproducts','totalorders','totalcustomers','deliveredOrders','processingorders','total_revenue','deliveredPercentage','processingPercentage','dispatchgorders','dispatchPercentage'));
        }
        else
        {   
            $userId = Auth::user()->id;
            $cartCount = Cart::where('user_id',$userId)->sum('quantity');
            $products = Product::query()->paginate(6)->withQueryString();
            session::put('cartCount',$cartCount);
            return view('frontend.index',compact('products'));
        }
    }

    public function view_category()
    {
        $categories = Category::get();
        return view('admin.category',compact('categories'));
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'category_name'=> 'required'
        ]);

        $data = array(
            'category_name'=> $request->category_name,
        );
        $create = Category::create($data);
        return redirect()->back()->with('message','Category Added successfuly');

    }

    public function delete_category(Request $request)
    {
        $id=$request->id;
        $category=Category::find($id);
        $category->delete();
        return redirect()->back()->with('success','Category Deleted successfuly');
    }

    public function edit(Request $request, Category $category)
    {
        $id=$request->id;
        $category=Category::find($id);
        return view('admin.category',compact('category'));
    }

    public function update(Request $request,Category $category)
    {
       
        $id=$request->id;
        $request->validate([
            'category_name'=> 'required'
        ]);

        $data = array(
            'category_name'=> $request->category_name,
        );
        $category=Category::find($id);
        if ($category) {
            $category->update($data); // Use the update() method on the model instance
            return redirect()->route('view_category')->with('message', 'Category updated successfully');
        } else {
            return redirect()->back()->with('error', 'Category not found');
        }

    }

    //send email to user
    public function send_email($id)
    {
        $order=Order::find($id);
        return view('admin.send_email',compact('order'));
    }

    public function send_user_email(request $request, $id) 
    {
       
        $order=Order::find($id);
        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
            ];

            Notification::send($order,new SendEmailNotification($details));

            return redirect()->route('orders');
    }
}
