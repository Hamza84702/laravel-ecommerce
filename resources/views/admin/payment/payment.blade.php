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
                        @if(session()->has('from3'))
                        <form action="{{route('payments')}}" method="GET">
                            <label for="start_date">From :</label>
                            <input type="date" id="start_date" name="start_date" required value="{{session('from3')}}">
                        @endif
                        @if(session()->has('to3'))
                            <label for="end_date">To :</label>
                            <input type="date" id="end_date" name="end_date" required value="{{session('to3')}}">
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
                            <th> Customer</th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th>Payment Mode</th>
                            <th>Payment Status</th>
                            <th>Reject/Cancel</th>
                            <th> Pending</th>
                            <th> Recived</th>
                            <th> Total </th>
                            <th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totalreject = 0; $totalpending = 0; $totalpaid = 0; 
                            ?>
                            @forelse($payments as $key => $payment)
                          <tr>
                            <td> {{$key + 1}} </td>
                            <td> {{$payment->name}} </td>
                            <td> {{$payment->email}} </td>
                            <td> {{$payment->phone}} </td>
                            <td>{{$payment->payment_method}}</td>
                            <td id="payment-status-{{$payment->id}}"> {{$payment->payment_status}} </td>
                            <td class="text-danger">
                                @if($payment->payment_status == 'reject') 
                                    ${{$payment->price}}
                                   <?php $totalreject += $payment->price; ?>
                                @endif
                            </td>
                            <td class="text-warning">
                                @if($payment->payment_status == 'pending') 
                                    ${{$payment->price}}
                                    <?php $totalpending += $payment->price; ?>
                                @endif
                            </td>
                            <td class="text-success">
                                @if($payment->payment_status == 'Paid') 
                                    ${{$payment->price}}
                                    <?php $totalpaid += $payment->price; ?>
                                @endif
                            </td>
                            <td></td>
                           
                            <td><a href="{{route('order_pdf',$payment->id)}}"><i class="mdi mdi-download" style="color:#0090e7" title="Download Invoice"></i></a>
                            <a href="{{route('send_email',$payment->id)}}"><i class="mdi mdi-email" style="color:#0090e7" title="Send Email"></i></a>
                            </td>
                          </tr>

                            @empty
                            <div class="mb-2">
                              <p>No Data Found</p>
                            </div>
                            @endforelse
                            <tr>
                            <td colspan="6"></td>
                            <td>Total Reject: <span ><br>${{$totalreject}}</span></td>
                            <td>Total Pending: <span ><br>${{$totalpending}}</span></td>
                            <td><b>Total Paid:</b> <span ><br>${{$totalpaid}}</span></td>
                            <td class="text-primary">Grand Total: <span ><br>${{$totalreject + $totalpending + $totalpaid}}</span></td>
                            </tr>
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

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</script> -->


@endsection