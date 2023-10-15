@extends('user.layout.master')



@section('content')



    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                     @foreach ($cart as $c )
                     <tr>
                        <td class="align-middle"> {{$c->product_name}}</td>
                        <td class="align-middle" >{{$c->product_price}} Kyats</td>
                        <input type="hidden" name="" id="cartId" value="{{$c->cart_id}}">
                        <input type="hidden" id="price" value="{{$c->product_price}}">
                        <input type="hidden" name="" id="productId" value="{{$c->product_id}}">
                        <input type="hidden" name="" id="userId" value="{{Auth::user()->id}}">
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" id="btnMinus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->quantity}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus" id="btnPlus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{$c->product_price * $c->quantity}} kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" ><i class="fa fa-times"></i></button></td>
                    </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{$total}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">5000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="final">{{$total + 5000 }} </h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 order" >Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 clear" >Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('jaquerysection')
<script>
    $(document).ready(function(){
        $('.btn-plus').click(function(){
            $parent = $(this).parents('tr');
            $price = $parent.find('#price').val();
            $qty = $parent.find('#qty').val();
         $total = $price * $qty;

         $parent.find('#total').html($total +  'kyats');
          $subtotal = 0;
         $('#dataTable tr').each(function(index,row){
         $subtotal += Number($(row).find('#total').text().replace('kyats',''));

         })
         $('#subTotal').html($subtotal + 'kyats')
         $('#final').html($subtotal + 5000 + 'kyats')
        })
         $('.btn-minus').click(function(){
            $parent = $(this).parents('tr');
            $price = $parent.find('#price').val();
            $qty = $parent.find('#qty').val();
         $total = $price * $qty;
         $subtotal = 0;
         $parent.find('#total').html($total + 'kyats');
          $('#dataTable tr').each(function(index,row){
         $subtotal += Number($(row).find('#total').text().replace('kyats',''));

         })
         $('#subTotal').html($subtotal + 'kyats')
         $('#final').html($subtotal + 5000 + 'kyats')

        })
        $('.btnRemove').click(function(){
         $parent = $(this).parents('tr');
         $parent.remove();
          $price = $parent.find('#price').val();
        $qty = $parent.find('#qty').val();
        $cartId = {
            'cartId' : $parent.find('#cartId').val()
        };

         $total = $price * $qty;
         $subtotal = 0;
         $parent.find('#total').html($total + 'kyats');
          $('#dataTable tr').each(function(index,row){
         $subtotal += Number($(row).find('#total').text().replace('kyats',''));

         })
         $('#subTotal').html($subtotal + 'kyats')
         $('#final').html($subtotal + 5000 + 'kyats')
         $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/ajax/clear',
                        dataType: 'json',
                        data:$cartId,
                    })

        })

        $('.order').click(function(){
            $order = [];
             $x = Math.floor((Math.random() * 100000) + 1);

            $('#dataTable tbody tr').each(function(index,row){
                $order.push({
                    'userId' :$(row).find('#userId').val(),
                    'productId' :$(row).find('#productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' :$(row).find('#total').text().replace('kyats','')*1,
                    'orderCode' : '10000' + $x
                });
            });
            $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/ajax/order',
                        dataType: 'json',
                        data: Object.assign({},$order),
                        success: function(response){
                            if(response.status == 'success'){
                                window.location.href = '/pizza_order_system/public/user/home';
                            }

                        }

                    })
    })
    $('.clear').click(function(){
       $('#dataTable tbody tr').remove();
       $('#subTotal').html('0 kyats');
       $('#final').html('5000 kyats');
       $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/ajax/clear/cart',
                        dataType: 'json',
                    })

        })
})
</script>
@endsection
