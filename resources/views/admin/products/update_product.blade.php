@extends('admin.layouts.main')
@section('main-content') 
<div class="main-panel">
    <div class="content-wrapper">
        @if(session()->has('message'))
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{session()->get('message')}}
        </div>
        @endif
    <div class="container mt-5" >
        <div class="card mx-auto">
            <div class="card-header">
                Product Information
            </div>
            <div class="card-body" style="color:balck;">
                <form action="{{route('update_product',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3" style="color:black">
                        <label for="productTitle" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="productTitle" placeholder="Enter product title" name="product_title" value="{{$product->title}}" Required>
                        @error('product_title')
                            <span class="text-danger">Please Enter the Product Title</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="productPrice" placeholder="Enter product price" name="product_price" value="{{$product->price}}" Required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" class="form-control" id="discount" placeholder="Enter discount" name="product_discount" value="{{$product->discount_price}}" Required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="product_quantity" value="{{$product->quantity}}" Required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select class="form-select" id="category" style="color:black" name="category" Required>
                            <option value="{{$product->category}}" selected>{{$product->category}}</option>
                            @foreach($categories as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <div class="mb-2">
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="image" width="100px" height="100px" />
                        </div>
                        <input type="file" class="form-control" id="productImage" name="image" >
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" rows="3"
                            placeholder="Enter product description" name="product_description" Required>{{$product->description}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection