
<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">
               @foreach($products as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{route('productdetails',$product->id)}}" class="option1">
                           Product Details
                           </a>
                           <form action="{{route('add_cart',$product->id)}}" method="POST">
                              @csrf
                              <div class="row">
                                 <div class="col-md-2">
                                    <input type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}" style="width:50px">
                                 </div>
                                 <div class="col-md-2">
                                    <input type="submit" value="Add To Cart">
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{url('uploads/products/'.$product->image)}}" alt="" width="520" height="800">
                     </div>
                     <div class="detail-box">
                           <h5>
                              {{$product->title}}
                           </h5>
                           <div class="price-container">
                           <div class="price-item">
                              @if($product->discount_price !=null && $product->discount_price !=0)
                              <span class="label pl-2">WAS: </span>
                              <span class="old-price">${{$product->price}}</span>
                              @endif
                           </div>
                           <div class="price-item">
                           @if($product->discount_price !=null && $product->discount_price !=0)
                              <span class="label">NOW: </span>
                           @else
                           <span class="label">Price: </span>   
                           @endif

                              <span class="new-price">${{$product->price - $product->discount_price}}</span>
                           </div>
                        </div>
                  </div>
                        </div>
                        
               </div>
               @endforeach

              
            </div>
            <div class="pagination mt-2 vertical-center">
               {!! $products->links('vendor.pagination.bootstrap-4') !!}
            </div>
            <div class="btn-box">
               <a href="">
               View All products
               </a>
            </div>
         </div>

         
      </section>