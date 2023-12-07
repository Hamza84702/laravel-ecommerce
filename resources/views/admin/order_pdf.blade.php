<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      body{
      margin-top:10px;
      background:#eee;
  }

    </style>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container bootdey">
    <div class="row invoice row-printable">
        <div class="col-md-10">
            <!-- col-lg-12 start here -->
            <div class="panel panel-default plain" id="dash_0">
                <!-- Start .panel -->
                <div class="panel-body p30">
                    <div class="row">
                        <!-- Start .row -->
                        <div class="col-lg-6">
                            <!-- col-lg-6 start here -->
                            <div class="invoice-logo"><img width="100" src="{{ public_path().'/images/logo1.png'}}" alt="Invoice logo"></div>
                        </div>
                        <!-- col-lg-6 end here -->
                        <div class="col-lg-6">
                            <!-- col-lg-6 start here -->
                            <div class="invoice-from">
                                <ul class="list-unstyled text-right">
                                    <li>Noorsaffron Ltd</li>
                                    <li>Lahore,Pakistan</li>
                                    <li>03123456789</li>
                                    <!-- <li>VAT Number EU826113958</li> -->
                                </ul>
                            </div>
                        </div>
                        <!-- col-lg-6 end here -->
                        <div class="col-lg-12">
                            <!-- col-lg-12 start here -->
                            <div class="invoice-details mt25">
                                <div class="well">
                                    <ul class="list-unstyled mb0">
                                        <li><strong>Invoice</strong> #936988</li>
                                        <li><strong>Invoice Date:</strong> <span style="color:black">{{$currentDate}}</span></li>
										<li><strong>Due Date:</strong> <span>{{$dueDate}}</span></li>
                                        <li><strong>Status:</strong> <span class="label label-danger">
											@if($order->payment_status == 'Paid')
  												
												{{$order->payment_status}}
											@else
  												UNPAID
											@endif
											</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="invoice-to mt25">
                                <ul class="list-unstyled">
                                    <li><strong>Invoiced To</strong></li>
                                    <li>{{$order->name}}</li>
                                    <li>{{$order->address}}</li>
									<li>{{$order->phone}}</li>
                                    <!-- <li>New York, NY, 2014</li>
                                    <li>USA</li> -->
                                </ul>
                            </div>
                            <div class="invoice-items">
                                <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
											<th class="per70 text-center">Order Date</th>
                                                <th class="per70 text-center">Product Name</th>
                                                <th class="per5 text-center">Price</th>
												<th class="per5 text-center">Qty</th>
                                                <th class="per25 text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
												<td class="text-center">{{$order->Created_at}}</td>
                                                <td class="text-center">{{$order->product_title}}</td>
												<td class="text-center">${{$order->price}}</td>
                                                <td class="text-center">{{$order->quantity}}</td>
												<td class="text-center">${{$order->price * $order->quantity}}</td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-right">Sub Total:</th>
                                                <td class="text-center">${{$order->price * $order->quantity}} USD</td>
                                            </tr>
                                            <tr>
                                                <th colspan="4" class="text-right">20% VAT:</th>
                                                <td class="text-center">$0</td>
                                            </tr>
                                            <tr>
                                                <th colspan="4" class="text-right">Credit:</th>
                                                <td class="text-center">$00.00 USD</td>
                                            </tr>
                                            <tr>
                                                <th colspan="4" class="text-right">Total:</th>
                                                <td class="text-center">${{$order->price * $order->quantity}} USD</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-footer mt25">
                                <p class="text-center">Generated By Noorsaffron.com <a href="#" class="btn btn-default ml15"><i class="fa fa-print mr5"></i></a></p>
                            </div>
                        </div>
                        <!-- col-lg-12 end here -->
                    </div>
                    <!-- End .row -->
                </div>
            </div>
            <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
    </div>
    </div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		
    // Get the current date
    var currentDate = new Date();


    // Format the date as you want (for example: YYYY-MM-DD)
    var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();

    // Update the content of the <span> element with id "invoice-date"
    document.getElementById('invoice-date').textContent = formattedDate;

    // Calculate one month from the current date
    var dueDate = new Date();
    dueDate.setMonth(dueDate.getMonth() + 1);

    // Format the due date as you desire (for example: YYYY-MM-DD)
    var formattedDueDate = dueDate.getFullYear() + '-' + (dueDate.getMonth() + 1) + '-' + dueDate.getDate();

    // Update the content of the <span> element with id "due-date"
    document.getElementById('due-date').textContent = formattedDueDate;
</script>

  </body>
</html>
