<style>
    .mdi.mdi-download {
        cursor: pointer;
    }

    .mdi.mdi-download:hover {
        cursor: pointer;
    }
    .search-container {
    display: flex;
    align-items: center;
    width: 18%;
    border-bottom: 1px solid white; /* Set bottom border properties */
    position: relative;
}

.search-icon {
    margin-right: 10px; /* Adjust the space between icon and input if needed */
}

.search-input {
    border: none !important;
    outline: none !important;
    width: 18%; /* Set input width */
    background-color: transparent !important;
    color:white !important;
}
.search-input:focus {
    box-shadow: 0 0 5px rgba(0, 0, 0, 0) !important;
}

/* styles.css */
#start_date, #end_date {
    display: inline-block !important;
    border: none !important;
    outline: none !important;
    border-bottom: 1px solid #ccc !important;
    background-color: transparent !important;
    margin-right: 20px !important;
    padding: 5px !important;
    width: 150px !important;
}

#start_date::-webkit-calendar-picker-indicator,
#end_date::-webkit-calendar-picker-indicator {
    filter: invert(20%) sepia(91%) saturate(477%) hue-rotate(193deg) brightness(90%) contrast(85%);
}
</style>
@extends('admin.layouts.main')
@section('main-content') 
<div class="main-panel" style="width:100%">
    <div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Order Details</h4>
                    <p class="card-description">  <code></code>
                    </p>
                      <div class="row mb-4 justify-content-center">
                        @if(session()->has('from1'))
                        <form action="{{route('orders')}}" method="GET">
                            <label for="start_date">From :</label>
                            <input type="date" id="start_date" name="start_date" required value="{{session('from1')}}">
                        @endif
                        @if(session()->has('to1'))
                            <label for="end_date">To :</label>
                            <input type="date" id="end_date" name="end_date" required value="{{session('to1')}}">
                        @endif
                            <input class="btn btn-primary" type="submit" value="Search">
                        </form>
                    </div>
                    <div class="row mb-4 justify-content-center">
                    <form action="{{route('orders_list_pdf')}}" method="GET">
                        @if(session()->has('from1'))
                            <input type="hidden" id="start_date" name="start_date" value="{{ session('from1') }}">
                        @endif
                        @if(session()->has('to1'))
                            <input type="hidden" id="end_date" name="end_date" value="{{ session('to1') }}">
                        @endif
                      <button class="btn btn-primary" style="display: flex; align-items: center;">
                        <img src="{{url('images/pdf.png')}}" alt="" style="width: 20px; height: 20px; margin-right: 5px;"> Download PDF
                      </button>
                      </form>
                      &nbsp;
                      <form action="{{ route('orders_list_Excel') }}" method="GET">
                        @if(session()->has('from1'))
                            <input type="hidden" id="start_date" name="start_date" value="{{ session('from1') }}">
                        @endif
                        @if(session()->has('to1'))
                            <input type="hidden" id="end_date" name="end_date" value="{{ session('to1') }}">
                        @endif
                        <button class="btn btn-success" style="display: flex; align-items: center;">
                            <img src="{{ url('images/excel.png') }}" alt="" style="width: 20px; height: 20px; margin-right: 5px;">Download Excel
                        </button>
                    </form>
                    </div>
                    <form action="{{route('search_order')}}" method="get">
                    <div class="mt-3 inputs mb-4">
                      <div class="search-container">
                          <i class="fa fa-search search-icon"></i>
                          @if(session()->has('searchData'))
                          <input type="text" class="form-control search-input" placeholder="Search Here..." name="search" value="{{session()->get('searchData')}}">
                          @else
                          <input type="text" class="form-control search-input" placeholder="Search Here..." name="search">
                          @endif
                      </div>
                  </div>
                  </form>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Address </th>
                            <th> Phone </th>
                            <th> Product Title </th>
                            <th> Quantity </th>
                            <th> Price</th>
                            <th> Payment Status </th>
                            <th> Delivery Status </th>
                            <th> Image </th>
                            <th> Update Status </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $key => $order)
                          <tr>
                            <td> {{$key + 1}} </td>
                            <td> {{$order->name}} </td>
                            <td> {{$order->email}} </td>
                            <td> {{$order->address}} </td>
                            <td> {{$order->phone}} </td>
                            <td> {{$order->product_title}} </td>
                            <td> {{$order->quantity}} </td>
                            <td> {{$order->price}} </td>
                            <td id="payment-status-{{$order->id}}"> {{$order->payment_status}} </td>
                            <td id="delivery-status-{{$order->id}}"> 
                                @if($order->delivery_status == 'Processing')
                                 <span style="color:blue !important;">{{$order->delivery_status}}</span>
                                @elseif($order->delivery_status == 'Deliverd')
                                  <span style="color:green;">{{$order->delivery_status}}</span>
                                @elseif($order->delivery_status == 'Dispatch')
                                  <span style="color:orange;">{{$order->delivery_status}}</span>
                                @elseif($order->delivery_status == 'Cancel')
                                  <span style="color:red;">{{$order->delivery_status}}</span>
                                @else
                                {{$order->delivery_status}}
                                @endif
                                
                            </td>
                            <td> 
                                <div>
                                    <img src="{{url('uploads/products/'.$order->image)}}" alt="" height="300px;" width="300px">
                                </div>
                            </td>
                            <td>
                            <select name="delivery_status" class="delivery-status" data-order-id="{{$order->id}}">
                                <option value="Processing" {{ $order->delivery_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Dispatch" {{ $order->delivery_status == 'Dispatch' ? 'selected' : '' }}>Dispatch</option>
                                <option value="Deliverd"{{ $order->delivery_status == 'Deliverd' ? 'selected' : '' }}>Deliverd</option>
                                <option value="Cancel" {{ $order->delivery_status == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                            </select>
                            </td>
                            <td><a href="{{route('order_pdf',$order->id)}}"><i class="mdi mdi-download" style="color:#0090e7" title="Download Invoice"></i></a>
                            <a href="{{route('send_email',$order->id)}}"><i class="mdi mdi-email" style="color:#0090e7" title="Send Email"></i></a>
                            </td>
                          </tr>

                            @empty
                            <div class="mb-2">
                              <p>No Data Found</p>
                            </div>
                            @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div>
              </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function () {
        $('.delivery-status').on('change', function () {
            var orderId = $(this).data('order-id'); 
            var newStatus = $(this).val(); 

            $.ajax({
                url: '{{ route('update.delivery.status') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: orderId,
                    delivery_status: newStatus
                },
                success: function (response) {
                    // Update the corresponding <td> element with the new status from the server
                    $('#payment-status-' + orderId).text(response.updatedPaymentStatus);
                    $('#delivery-status-' + orderId).text(response.updatedStatus);

                    if (newStatus === 'Processing') {
                    $('#delivery-status-' + orderId).css('color', 'blue');
                } else if (newStatus === 'Deliverd') {
                    $('#delivery-status-' + orderId).css('color', 'green');
                } else if (newStatus === 'Dispatch') {
                    $('#delivery-status-' + orderId).css('color', 'orange');
                } else if (newStatus === 'Cancel') {
                    $('#delivery-status-' + orderId).css('color', 'red');
                } else {
                    $('#delivery-status-' + orderId).css('color', ''); // Reset color to default
                }
                
                    console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>


@endsection