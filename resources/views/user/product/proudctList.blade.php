@extends('user.layout.master')
@section('content')



    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control  d-flex align-items-center justify-content-between mb-3">
                            <input  class="custom-control-input" name="sss">
                            <a href="{{route('user#home')}}" class="text-dark ">
                                <h5> - All Category</h5>
                            </a>
                        </div>
                        @foreach ($category as $c)
                            <div class="custom-control  d-flex align-items-center justify-content-between mb-3">
                               <a href="{{route('user#cate',$c->id)}}" class="text-decoration-none text-dark " method="get">
                                <h5>- {{ $c->name }}</h5>
                               </a>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->

                <!-- Color End -->

                <!-- Size Start -->


                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button type="button" class="btn  position-relative"><a class="btn btn-light ml-2" href="{{route('user#history')}}"><i class="fa-solid fa-clock-rotate-left"></i> History</a>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{count($history)}}
                                    </span>
                                  </button>
                                <button type="button" class="btn  position-relative"><a class="btn btn-light ml-2" href="{{route('cart#edit')}}"><i class="fa-solid fa-cart-shopping"></i></a>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{count($cart)}}
                                    </span>
                                  </button>

                            </div>
                            <div class="ml-2 d-flex">
                                <div class="">
                                    <select name="sorting" id="sortingOption" class="form-control ">
                                        <option value="">Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="row" id="sortingData">
                   @if (count($data) != 0)
                   @foreach ($data as $d)
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                       <div class="product-item bg-light mb-4">
                           <div class="product-img position-relative overflow-hidden">
                               <img class="img-fluid w-100" src="{{ asset('storage/' . $d->image) }}" style="height: 350px" alt="">
                               <div class="product-action">
                                   <a class="btn btn-outline-dark btn-square" href="{{route('cart#edit')}}">
                                   <i class="fa-solid fa-cart-shopping"></i></a>
                                   <a class="btn btn-outline-dark btn-square"  href="{{route('product#detail',$d->id)}}"> <i class="fa-solid fa-circle-info"></i></a>
                               </div>
                           </div>
                           <div class="text-center py-4">
                               <a class="h6 text-decoration-none text-truncate" href="">{{ $d->name }}</a>
                               <div class="d-flex align-items-center justify-content-center mt-2">
                                   <h5>{{ $d->price }} kyats</h5>
                               </div>

                           </div>
                       </div>
                   </div>
               @endforeach
                       @else
                   <h3>There is no Data...</h3>
                   @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
    </div>
    <!-- Shop End -->
@endsection


@section('jaquerysection')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $evetnoption = $('#sortingOption').val();
                if ($evetnoption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/ajax/pizzalist',
                        dataType: 'json',
                        data: {
                            'status': 'desc'
                        },
                        success: function(response) {
                            console.log(response);
                            $list = "";
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                  <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" style="height: 350px" alt="">
                   <div class="product-action">
                    <div class="product-action">
                                   <a class="btn btn-outline-dark btn-square" href="{{route('cart#edit')}}">
                                   <i class="fa-solid fa-cart-shopping"></i></a>
                                   <a class="btn btn-outline-dark btn-square"  href="{{route('product#detail',$d->id)}}"> <i class="fa-solid fa-circle-info"></i></a>
                               </div>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${response[$i].price} kyats</h5>
                    </div>

                </div>
            </div>
        </div>

                `;
                                console.log($list);
                            }
                            $('#sortingData').html($list);
                        }

                    })
                } else {
                    $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/ajax/pizzalist',
                        dataType: 'json',
                        data: {
                            'status': 'asc'
                        },
                        success: function(response) {

                            $list = "";
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `

                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                  <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" style="height: 350px" alt="">
                   <div class="product-action">
                    <div class="product-action">
                                   <a class="btn btn-outline-dark btn-square" href="{{route('cart#edit')}}">
                                   <i class="fa-solid fa-cart-shopping"></i></a>
                                   <a class="btn btn-outline-dark btn-square"  href="{{route('product#detail',$d->id)}}"> <i class="fa-solid fa-circle-info"></i></a>
                               </div>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>${response[$i].price} kyats</h5>
                    </div>
                </div>
            </div>
        </div>

                `;
                                console.log($list);
                            }
                            $('#sortingData').html($list);
                        }

                    })
                }
            });
        });
    </script>
@endsection
