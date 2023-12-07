@extends('frontend.layouts.main')

      
        
    @section('content')
      
      <!-- why section -->
      <div class="row justify-content-center mt-5 col-md-12" style="background-color:#f5f5f5">
      <h3>  SHOPPING CART [ <small>{{ session('cartCount') ?? 0 }} Item(s) </small>]<a href="{{route('products_page')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>

      </div>
     <div class="row justify-content-center mt-5 mb-5" >
        <div class="col-md-8">
        <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Title</th>
                  <th>Quantity/Update</th>
				  <th>Price</th>
                  <th>Total</th>
                  <th>Action</th>
				</tr>
              </thead>
              <tbody>
                <?php $totalprice=0; ?>
              @forelse($carts as $cart)
                <tr>
                  <td> <img width="60" src="{{url('uploads/products/'.$cart->image)}}" alt=""/></td>
                  <td>{{$cart->product_title}}</td>
                  <td>
                    <div class="input-append">
                        <input type="number" class="quantity-input" value="{{$cart->quantity}}" min="1" max="" name="quantity"
                              data-product-id="{{$cart->id}}" data-unit-price="{{$cart->unit_price}}">
                    </div>
                  </td>
                  <td class="unit-price">${{$cart->unit_price}}</td>
                  <td class="total-price" data-product-id="{{$cart->id}}">{{$cart->unit_price * $cart->quantity}}</td>
                  <td><a href="{{route('cart_delete',$cart->id)}}" onclick="confirmation (event)"><i class="fa fa-trash" aria-hidden="true" style="color: red;"></i></a>
                  </td>
                  
                </tr>
                <?php $totalprice = $totalprice +  $cart->price ?>
                @empty
              
                  <td class="text-center" colspan="6">Your Cart is empty</td>
                 
				@endforelse
          
                <tr>
                  <td colspan="6" style="text-align:right">Total Price:	</td>
                  <td> ${{$totalprice}}</td>
                </tr>
				 <tr>
                  <td colspan="6" style="text-align:right">Total Discount:	</td>
                  <td> 0 </td>
                </tr>
                 <tr>
                  <td colspan="6" style="text-align:right">Total Tax:	</td>
                  <td> 0 </td>
                </tr>
				        <tr>
                  <td colspan="6" style="text-align:right"><strong>TOTAL (${{$totalprice}} +$0 +$0) =</strong></td>
                  <td id="total-cart-price" class="label label-important" style="display:block; background-color:#e8e5e5; width:100%;"> <strong> ${{$totalprice}}</strong></td>
                </tr>
               
                
                
				</tbody>
            </table>
            
        </div>
     </div>
     <!-- <div class="row justify-content-center">
            <h1 style="font-size: 25px; padding-bottom: 15px;">
                Proceed to Checkout</h1>
               
      </div> -->
      @if(count($carts) > 0)
      <div class="row justify-content-center mb-5">       
          <a href="{{ route('checkout') }}" class="btn btn-dark">Proceed TO Checkout</a>
      </div>
      @else
      <div class="row justify-content-center mb-5">
          <a href="{{ route('products_page') }}" class="btn btn-dark">Continue Shopping</a>
      </div>
      @endif
      
      <!-- @if(count($carts) > 0)
        <div class="row justify-content-center mb-5"> 
            <a href="{{route('cash_order')}}" class="btn btn-danger mr-2">Cash On Delivery</a>
            <a href="{{route('stripe_order', $totalprice)}}" class="btn btn-danger">Pay Using Card</a>
        </div>
    @else
        <div class="row justify-content-center mb-5"> 
            <button class="btn btn-danger mr-2" disabled>Cash On Delivery</button>
            <button class="btn btn-danger" disabled>Pay Using Card</button>
        </div>
    @endif -->

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

function confirmation(ev)
{
ev.preventDefault();
var urlToRedirect=ev.currentTarget.getAttribute('href');
console.log(urlToRedirect);
swal({
title: "Are you Sure to delete this",
text: "You won't be able to revert this delete",
icon: "warning",
buttons: true,
})
.then((willCancel) =>
{
if(willCancel)
{
window.location.href=urlToRedirect;
}
});
}
</script>

<script>
  $(document).ready(function(){
    $('.quantity-input').on('input', function(){
      var quantity = $(this).val();
      var unitPrice = $(this).data('unit-price');
      var productId = $(this).data('product-id');
      var totalPrice = unitPrice * quantity;

      // Update the displayed total price in the same row
      $('.total-price[data-product-id="' + productId + '"]').text('$' + totalPrice);

      // Recalculate the total cart price
      var newTotalCartPrice = calculateTotalCartPrice();
      
      // Update the displayed total cart price
      $('#total-cart-price').html('<strong>$' + newTotalCartPrice + '</strong>');

      // Ajax request to update cart
      $.ajax({
        url: '/cart', // Replace with your actual endpoint
        method: 'POST',
        data: {
            productId: productId,
            quantity: quantity,
            totalPrice: totalPrice,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            // Handle success if needed
            console.log(response);
        },
        error: function (error) {
            // Handle error if needed
            console.error(error);
        }
      });
    });

    function calculateTotalCartPrice() {
      var totalCartPrice = 0;
      
      // Loop through all products and sum up their total prices
      $('.total-price').each(function() {
        var productTotalPrice = parseFloat($(this).text().replace('$', ''));
        totalCartPrice += isNaN(productTotalPrice) ? 0 : productTotalPrice;
      });

      return totalCartPrice.toFixed(2); // Format the total to two decimal places
    }
  });
</script>



    @endsection
    