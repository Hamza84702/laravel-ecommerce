@extends('frontend.layouts.main')

      
        
    @section('content')
      
      <!-- why section -->
      <!-- <div class="row justify-content-center mt-5 col-md-12" style="background-color:#f5f5f5">
      <h3>  SHOPPING CART [ <small>{{ session('cartCount') ?? 0 }} Item(s) </small>]<a href="{{route('products_page')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>

      </div> -->
     <div class="row justify-content-center mt-5 mb-5" >
        <div class="col-md-8">
                <?php $totalprice=0; ?>
            @foreach($cartdata as $cart)
                
                <?php $totalprice = $totalprice +  $cart->price ?>
              
			@endforeach
    
        </div>
     </div>
     <div class="row justify-content-center">
            <h1 style="font-size: 25px; padding-bottom: 15px;">
                Select your Payment Method</h1>            
      </div>     
        <div class="row justify-content-center mb-5"> 
            <a href="{{route('cash_order')}}" class="btn btn-danger mr-2">Cash On Delivery</a>
            <a href="{{route('stripe_order', $totalprice)}}" class="btn btn-danger">Pay Using Card</a>
        </div>
   
   

      <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<!-- <script>

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
</script> -->
    @endsection
    