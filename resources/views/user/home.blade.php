@extends('user.layout.masteruser')
@section('content')
<section class="new_arrivals_area section_padding_100_0 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>New Arrivals</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row karl-new-arrivals">
            @foreach($product as $item)
            <!-- Single gallery Item Start -->
            <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.2s">
                <!-- Product Image -->
                <div class="product-img">
                <img style="height:200px" src="{{$item['thumbnail']}}" alt="{{$item['thumbnail']}}"></td>
                    <div class="product-quicview">
                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                    </div>
                </div>
                <!-- Product Description -->
                <div class="product-description">
                    <h4 class="product-price">{{$item['price']}} VND</h4>
                    <p>{{$item['name']}}</p>
                    <!-- Add to Cart -->
                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                </div>
            </div>
            @endforeach


        </div>
    </div>

</section>
@endsection