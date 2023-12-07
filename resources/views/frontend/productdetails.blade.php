<style>
.animated-button {
    position: relative !important;
    overflow: hidden !important;
    z-index: 1  !important;
    border: none !important;
    border-radius: 5px !important;
    padding: 10px 20px !important;
    font-size: 16px;
    cursor: pointer;
    background-color: transparent;
    transition: background-color 0.3s ease;
}

.animated-button .icon {
    width: 20px; /* Set the width of the icon */
    height: 20px; /* Set the height of the icon */
    margin-right: 10px;
    transition: transform 0.3s ease;
}

.animated-button:hover {
    background-color: rgba(0, 123, 255, 0.8); /* Transparent blue color */
}

.animated-button:hover .icon {
    transform: translateX(10px); /* Adjust the value as needed for the desired position */
}

.animated-button .button-text {
    transition: opacity 0.3s ease;
}

.animated-button .icon,
.animated-button:hover .button-text {
    opacity: 1;
}
.product-inf {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    margin-top: 10px !important; /* Add margin if necessary */
}
.button-container {
    display: flex !important;
    align-items: center !important;
}

.btn {
    margin-right: 10px !important; /* Adjust the margin as needed */
}

.quantity-input {
    width: 60px; /* Set the width of the input field as needed */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    
}




</style>
@extends('frontend.layouts.main')
@section('content')
    <div class="hero_area">

        <!-- Product Details Section -->
        <div class="container mt-5 mb-5"> <!-- Added mb-5 for bottom margin and mt-5 for top margin -->
            <div class="row">
                <div class="col-md-6">
                    <img src="{{url('uploads/products/'.$productdetail->image)}}" class="img-fluid" alt="Product Image">
                </div>
                <div class="col-md-6">
                    <h2>Product Name: {{$productdetail->title}}</h2>
                    <p>{{$productdetail->description}}</p>
                    <div class="product-inf">
                        <h5 class="pr-5">Category: {{$productdetail->category}}</h5>
                        <h5 class="pl-5">Left: {{$productdetail->quantity}}</h5>
                    </div>
                    <div class="price-container mb-4 mt-4">
                    <h4>Price:</h4>
                           <div class="price-item">
                            
                              @if($productdetail->discount_price !=null && $productdetail->discount_price !=0)
                              <span class="label pl-2">WAS: </span>
                              <span class="old-price">${{$productdetail->price}}</span>
                              @endif
                           </div>
                           <div class="price-item">
                           @if($productdetail->discount_price !=null && $productdetail->discount_price !=0)
                              <span class="label">NOW: </span>
                           @else
                           <span class="label">Price: </span>   
                           @endif

                              <span class="new-price">${{$productdetail->price - $productdetail->discount_price}}</span>
                           </div>
                        </div>
                        <form action="{{route('add_cart',$productdetail->id)}}" method="POST">
                            @csrf
                            <label for=""><b>Qty:</b></label>
                            <input type="number" class="quantity-input" value="1" min="1" max="{{$productdetail->quantity}}" name="quantity">
                                <div class="button-container">
                                    <button class="btn btn-primary animated-button">
                                        <img src="{{url('images/cart.png')}}" alt="Cart Icon" class="icon">
                                        <span class="button-text">Add to Cart</span>
                                    </button>
                        </form>
                                </div>

                </div>
            </div>
        </div>
        <!-- End Product Details Section -->

    </div>
@endsection
