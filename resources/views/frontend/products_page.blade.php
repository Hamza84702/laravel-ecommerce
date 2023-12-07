<style>
  body{
margin-top:20px;
background:#ebeef0;
}

.img-sm {
width: 46px;
height: 46px;
}

.panel {
box-shadow: 0 2px 0 rgba(0,0,0,0.075);
border-radius: 0;
border: 0;
margin-bottom: 15px;
}

.panel .panel-footer, .panel>:last-child {
border-bottom-left-radius: 0;
border-bottom-right-radius: 0;
}

.panel .panel-heading, .panel>:first-child {
border-top-left-radius: 0;
border-top-right-radius: 0;
}

.panel-body {
padding: 25px 20px;
}


.media-block .media-left {
display: block;
float: left
}

.media-block .media-right {
float: right
}

.media-block .media-body {
display: block;
overflow: hidden;
width: auto
}

.middle .media-left,
.middle .media-right,
.middle .media-body {
vertical-align: middle
}

.thumbnail {
border-radius: 0;
border-color: #e9e9e9
}

.tag.tag-sm, .btn-group-sm>.tag {
padding: 5px 10px;
}

.tag:not(.label) {
background-color: #fff;
padding: 6px 12px;
border-radius: 2px;
border: 1px solid #cdd6e1;
font-size: 12px;
line-height: 1.42857;
vertical-align: middle;
-webkit-transition: all .15s;
transition: all .15s;
}
.text-muted, a.text-muted:hover, a.text-muted:focus {
color: #acacac;
}
.text-sm {
font-size: 0.9em;
}
.text-5x, .text-4x, .text-5x, .text-2x, .text-lg, .text-sm, .text-xs {
line-height: 1.25;
}

.btn-trans {
background-color: transparent;
border-color: transparent;
color: #929292;
}

.btn-icon {
padding-left: 9px;
padding-right: 9px;
}

.btn-sm, .btn-group-sm>.btn, .btn-icon.btn-sm {
padding: 5px 10px !important;
}

.mar-top {
margin-top: 15px;
}
body{

background-color: #eee;
}
.container{
width: 900px;
}

.card{

background-color: #fff;
border:none;
border-radius: 10px;
width: 190px;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}

.image-container{

position: relative;
}

.thumbnail-image{
border-radius: 10px !important;
}


.discount{

background-color: red;
padding-top: 1px;
padding-bottom: 1px;
padding-left: 4px;
padding-right: 4px;
font-size: 10px;
border-radius: 6px;
color: #fff;
}

.wishlist{

height: 25px;
width: 25px;
background-color: #eee;
display: flex;
justify-content: center;
align-items: center;
border-radius: 50%;
box-shadow:  0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.first{

position: absolute;
width: 100%;
    padding: 9px;
}


.dress-name{
font-size: 13px;
font-weight: bold;
width: 75%;
}


.new-price{
font-size: 13px;
font-weight: bold;
color: red;

}
.old-price{
font-size: 8px;
font-weight: bold;
color: grey;
}


.btn{
width: 14px;
height: 14px;
border-radius: 50%;
padding: 3px;
}

.creme{
background-color: #fff;
border: 2px solid grey;


}
.creme:hover {
border: 3px solid grey;
}

.creme:focus {
background-color: grey;

}


.red{
background-color: #fff;
border: 2px solid red;

}


.red:hover {
border: 3px solid red;
}
.red:focus {
background-color: red;
}



.blue{
background-color: #fff;
border: 2px solid #40C4FF;
}

.blue:hover {
border: 3px solid #40C4FF;
}
.blue:focus {
background-color: #40C4FF;
}
.darkblue{
background-color: #fff;
border: 2px solid #01579B;
}
.darkblue:hover {
border: 3px solid #01579B;
}
.darkblue:focus {
background-color: #01579B;
}
.yellow{
background-color: #fff;
border: 2px solid #FFCA28;
}
.yellow:hover {
border-radius: 3px solid #FFCA28;
}
.yellow:focus {
background-color: #FFCA28;
}


.item-size{
width: 15px;
height: 15px;
border-radius: 50%;
background: #fff;
border: 1px solid grey;
color: grey;
font-size: 10px;
text-align: center;
align-items: center;
display: flex;
justify-content: center;
}


.rating-star{
font-size: 10px !important;
}
.rating-number{
font-size: 10px;
color: grey;

}
.buy{
font-size: 12px;
color: purple;
font-weight: 500;
}














.voutchers{
background-color: #fff;
border:none;
border-radius: 10px;
width: 190px;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
overflow: hidden;

}
.voutcher-divider{

display: flex;

}
.voutcher-left{
width: 60%
}
.voutcher-name{
color: grey;
font-size: 9px;
font-weight: 500;
}
.voutcher-code{
color: red;
font-size: 11px;
font-weight: bold;
}
.voutcher-right{
width: 40%;	 
background-color: purple;
color: #fff;
}

.discount-percent{
font-size: 12px;
font-weight: bold;
position: relative;
top: 5px;
}
.off{
font-size: 14px;
position: relative;
bottom: 5px;
}
</style>
@extends('frontend.layouts.main')

        
@section('content')
        
<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div style="text-align: center;">
            <form action="{{route('products_search')}}" method="GET">
               @csrf
               <input style="width: 500px;" type="text" name="search_text" placeholder="Search for Something">
               <input type="submit" value="search">
            </form>
            </div>
            <div class="container mt-5">


    	<div class="row">
       @foreach($products as $product)
    		<div class="col-md-3">
    				<div class="card">
    					<div class="image-container">
    						<div class="first">					
    							<div class="d-flex justify-content-between align-items-center">
    							<span class="discount">-25%</span>
    							<span class="wishlist"><i class="fa fa-heart-o"></i></span>
    						    </div>
    						</div>
    						<img src="{{url('uploads/products/'.$product->image)}}" class="img-fluid rounded thumbnail-image">
    					</div>
    					<div class="product-detail-container p-2">

    							<div class="d-flex justify-content-between align-items-center">

    								<h5 class="dress-name">{{$product->title}}</h5>

    								<div class="d-flex flex-column mb-2">

    									<span class="new-price">${{$product->price - $product->discount_price}}</span>
                               @if($product->discount_price !=null && $product->discount_price !=0)
    									<small class="old-price text-right">${{$product->price}}</small>
                              @endif
    								</div>

    							</div>
    							<div class="d-flex justify-content-between align-items-center pt-1">

    								<!-- <div class="color-select d-flex ">

    									<input type="button" name="grey" class="btn creme">
    									<input type="button" name="red" class="btn red ml-2">
    									<input type="button" name="blue" class="btn blue ml-2">

    								</div> -->
    								<div class="d-flex ">
    									
    									<!-- <span class="item-size mr-2 btn" type="button">S</span>
    									<span class="item-size mr-2 btn" type="button">M</span>
    									<span class="item-size btn" type="button">L</span> -->

    								</div>
    							</div>
    							<div class="d-flex justify-content-between align-items-center pt-1">
    								<div>
    									<i class="fa fa-star-o rating-star"></i>
    									<span class="rating-number">4.8</span>
    								</div>

    								<span class="buy">BUY +</span>
    								
    							</div>
    					</div>			
    				</div>
    				<div class="mt-3">
    					<div class="card voutchers">

    						<div class="voutcher-divider">

    							<div class="voutcher-left text-center">
    								<span class="voutcher-name">Monday Happy</span>
    								<h5 class="voutcher-code">#MONHPY</h5>
    								
    							</div>
    							<div class="voutcher-right text-center border-left">
    								<h5 class="discount-percent">20%</h5>
    								<span class="off">Off</span>
    								
    							</div>
    								
    						</div>
    						
    					</div>
    					
    				</div>



    				

    			
    		</div>
      @endforeach

    	</div>



    	



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
            <div class="pagination justify-content-center" style="margin-top:20px !important; margin-bottom:20px !important;">
               {!! $products->links('vendor.pagination.bootstrap-4') !!}

               <div class="btn-box mt-4" >
               <a href="">
               View All products
               </a>
               </div>
            </div>
            
         </div>
        
         <div class="container bootdey" style="margin-top:30px !important;">
    <div class="col-md-12 bootstrap snippets">
        <div class="panel">
            <div class="panel-body">
                <form action="{{route('add_comment')}}" method="POST">
                        @csrf
                    <textarea class="form-control" rows="2" placeholder="What are you thinking?" aria-label="Write a comment" name="comment"></textarea>
                    <div class="mar-top clearfix">
                        <button class="btn btn-sm btn-primary pull-right" type="submit" aria-label="Share Comment"><i class="fa fa-pencil fa-fw"></i> Share</button>
                        <!-- <a class="btn btn-trans btn-icon fa fa-video-camera add-tooltip" href="#" aria-label="Attach Video"></a>
                        <a class="btn btn-trans btn-icon fa fa-camera add-tooltip" href="#" aria-label="Attach Photo"></a>
                        <a class="btn btn-trans btn-icon fa fa-file add-tooltip" href="#" aria-label="Attach File"></a> -->
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-2 mb-2">
        All Comments
        </div>

        @foreach($comments as $comment)
        <div>
                <b>{{$comment->name}}</b>
                <p>{{$comment->comment}}</p>
                <a href="javascript:void(0);" onClick="reply(this)" data-commentid="{{$comment->id}}">Reply</a>
                @if($comment->replies->count() > 0 && $comment->replies !==NULL)
                <div style="padding-left:3%;">
                        @foreach($comment->replies as $reply)
                        <b>{{$reply->name}}</b>
                        <p>{{$reply->reply}}</p>
                        <a href="javascript:void(0);" onClick="reply(this)" data-commentid="{{$comment->id}}">Reply</a>
                        @endforeach
                </div>
                @endif
        </div>
       @endforeach
        <div class="replyDiv" style="display:none" >
                <form action="{{route('add_reply')}}" method="POST">
                @csrf
                <input type="text" name="commentId" id="commentId" hidden="">
                <textarea  name="reply" id=""  placeholder="Reply Here..." style="width:400px !important; height:50px !important;"></textarea>
                <br>
                <button class="btn btn-sm btn-primary" type="submit" ><i class="fa fa-share" aria-hidden="true"></i> Reply</button>
                <a href="javascript:void(0);" onClick="reply_close(this)">Cancel</a>
                </form>
        </div>
    </div>

    
   
</div>
      </section>

      <script type="text/javascript">
        function reply(caller)
        {
                document.getElementById('commentId').value=$(caller).attr('data-commentid');
                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show()
        }
        function reply_close(caller)
        {
        $('.replyDiv').hide();
        }

</script>
<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
@endsection
