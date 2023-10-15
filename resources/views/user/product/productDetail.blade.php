 @extends('user.layout.master')

@section('content')




    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="col-9" src="{{asset('storage/'.$detail->image)}}" alt="Image">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>Product Name Goes Here</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">

                        </div>
                        <small class="pt-1"> <i class="fa-solid fa-eye"></i> {{$detail->view_count}} </small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$detail->price}} Kyats</h3>
                    <p class="mb-4">{{$detail->description}}</p>
                    <input type="hidden" id="pizzaId" class="pizzaId" value="{{$detail->id}}">
                    <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>

                            <input type="text" class="form-control bg-secondary border-0 text-center" id="cartQty" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="cartCreate"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                  @foreach ($pizza as $p )
                  <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="{{route('product#detail',$p->id)}}">
                                <i class="fa-solid fa-circle-info"></i></a>
                               <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-cart-shopping"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{$p->price}}</h5>
                        </div>
                    </div>
                </div>
                  @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('jaquerysection')
<script>
    $(document).ready(function() {

        $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/product/viewcount',
                        dataType: 'json',
                        data:{
                            'id' :  $('#pizzaId').val()
                        }

                         })




        $('#cartCreate').click(function(){
           $cartData = {
            'userId' : $('#userId').val(),
            'pizzaId' : $('#pizzaId').val(),
            'qty' : $('#cartQty').val(),
           }
           $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/cart/create',
                        dataType: 'json',
                        data: $cartData,
                        success : function(response){
                  if(response.status == 'success'){
                    window.location.href = '/pizza_order_system/public/user/home';
                  }
                     }
                         })
                             })



})
    </script>
@endsection
