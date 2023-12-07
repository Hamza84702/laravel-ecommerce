<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use File;
class ProductController extends Controller
{
    public function index()
    {
        $products=Product::all();
        return view('admin.products.product_list',compact('products'));
    }


    public function add_products()
    {
        $categories=Category::all();
        return view('admin.products.add_products',compact('categories'));
    }


    public function product_store(request $request)
    {
        

        $request->validate([
    
            'product_title'=>'required',
            'product_description'=>'required',
            'image'=>'required',
            'category'=>'required',
            'product_quantity'=>'required',
            'product_price'=>'required',
            'product_discount'=>'required',
        ]);

        if($request->hasFile('image'))
        {
            $image=$request->image;
            $imagename = time() . '.' .$image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
        }
        else
        {
            $imagename='';
        }
        
        $data= array(
            'title'	=> $request->product_title,
            'description' => $request->product_description,
            'category'	=> $request->category,
            'quantity' => $request->product_quantity,
            'price' => $request->product_price,
            'discount_price' => $request->product_discount,
            'image'=>$imagename
        );


        $product=Product::create($data);
        return redirect()->back()->with('message','Product Added Successfuly');
    }

    public function delete_product(request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        if($product)
        {
            // if($product->image && file_exists(public_path('uploads/products/'.$product->image)))
            // {
            //     unlink(public_path('uploads/products/'.$product->image));
               
                
            // }
            
            $product->delete();
            return redirect()->back()->with('message','Product Deleted Successfuly');
        }
        else
        {
            return redirect()->back()->with('message','Product not found');
        }
       
    }

    public function edit_product(request $request)
    {
        $id = $request->id;
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.products.update_product',compact('categories','product'));
    }

    public function update_product(Request $request)
    {
    $id = $request->id;

    $request->validate([
        'product_title' => 'required',
        'product_description' => 'required',
        'category' => 'required',
        'product_quantity' => 'required',
        'product_price' => 'required',
        'product_discount' => 'required',
    ]);

    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with('message', 'Product not found');
    }

    $data = [
        'title' => $request->product_title,
        'description' => $request->product_description,
        'category' => $request->category,
        'quantity' => $request->product_quantity,
        'price' => $request->product_price,
        'discount_price' => $request->product_discount,
    ];

    // Handle image update
    if ($request->hasFile('image')) {
        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/products'), $imageName);

        // Update image field only if a new image is uploaded
        $data['image'] = $imageName;
    }

    $product->update($data);

    return redirect()->route('view_products')->with('message', 'Product Updated Successfully');
    }

   
}


