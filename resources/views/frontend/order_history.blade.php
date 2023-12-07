@extends('frontend.layouts.main')

         
@section('content')

      
      <!-- why section -->
      <div class="row justify-content-center mt-5 col-md-12" style="background-color:#f5f5f5">
      <h3> <b>Your Order History</b> </h3>

      </div>
      @if(session()->has('message'))
            <div class ="alert alert-success alert-dismissible fade show text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>

        @endif
     <div class="row justify-content-center mt-5 mb-5" >
        <div class="col-md-8">
        <table class="table table-bordered">
              <thead>
                <tr class="text-center">
                  <th>Product</th>
                  <th>Title</th>
                  <th>Quantity/Update</th>
				  <th>Price</th>
                  <th>Total</th>
                  <th>Delivery Status</th>
                  <th>Action</th>
				</tr>
              </thead>
              <tbody>
                <?php $totalprice=0; ?>
              @foreach($orders as $order)
                <tr class="text-center">
                  <td> <img width="60" src="{{url('uploads/products/'.$order->image)}}" alt=""/></td>
                  <td>{{$order->product_title}}</td>
				  <td>
					{{$order->quantity}}
				  </td>
                  <td>{{$order->price}}</td>
                  <td>{{$order->price}}</td>
                  <td>{{$order->delivery_status}}</td>
                  @if($order->delivery_status == 'Processing')
                    <td><a href="{{route('cancel_order',$order->id)}}"><i class="fa fa-times-circle" aria-hidden="true" style="color:red"></i>&nbsp;Cancel</a></td>  
                  @else
                    <td>Not Allowed</td>
                  @endif
                </tr>
               
				@endforeach
                <!-- <tr>
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
                  <td class="label label-important" style="display:block; background-color:#e8e5e5; width:100%;"> <strong> ${{$totalprice}}</strong></td>
                </tr> -->
                
				</tbody>
            </table>
            
        </div>
     </div>
    
    
@endsection