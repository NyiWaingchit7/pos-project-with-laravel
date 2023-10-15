
@extends('admin.layout.master')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Category List</h2>

                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{route('category#createPage')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Add Category
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>

            </div>

            <div class="row">
                <div class="col-3 text-success">Search Key - {{request('key')}}</div>
                <div class="col-3 offset-6">
                    <form action="{{route('listPage')}}" class="d-flex " method="get">
                        <input type="text" name="key" placeholder="  Serach data.." value="{{request('key')}}">
                        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-3">
               <form action="{{route('order#status')}}" method="post">
                @csrf
               <div class="d-flex">
                <select name="dataStatus" class="form-control" id="order">
                    <option value="" >All</option>
                    <option value="0" @if (request('dataStatus') == '0') selected @endif >Pending</option>
                    <option value="1" @if (request('dataStatus') == '1') selected @endif>Accept</option>
                    <option value="2" @if (request('dataStatus') == '2') selected @endif>Reject</option>
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
               </div>
               </form>

            </div>
            @if (session('deleteSuccess'))
            <div class="alert alert-warning alert-dismissible fade show col-5 offset-7" role="alert">
                <small>{{ session('deleteSuccess') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if (session('passchange'))
            <div class="alert alert-success alert-dismissible fade show col-5 offset-7" role="alert">
                <small>{{ session('passchange') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="table-responsive table-responsive-data2">
              @if ( count($order) != 0)

              <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Order Code</th>
                        <th>Total Price</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody id="data">
                  @foreach ($order as $o )
                  <tr class="tr-shadow ">
                    <td>{{$o->created_at->format('Y-m-d')}}</td>
                    <input type="hidden" name="" id="pid" value="{{$o->id}}" >
                    <td>{{$o->user_name}}</td>
                    <td><a href="{{route('orderCodeList',$o->order_code)}}"> {{$o->order_code}} </a></td>
                    <td>{{$o->total_price}} kyats</td>
                    <td>
                        <select name="status" class="form-control col-4 status @if ($o->status == 0) text-warning border-warning @elseif ($o->status == 1) text-success border-success @elseif ($o->status == 2) text-danger border-danger @endif" >
                            <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                            <option value="1" @if ($o->status == 1) selected @endif >Accept</option>
                            <option value="2" @if ($o->status == 2) selected @endif >Reject</option>

                        </select>
                    </td>
                </tr>

                  @endforeach

                </tbody>
            </table>
            @else

            <h3 class="text-muted mt-5">There is no DATA..</h3>

              @endif
                <div class="mt-1">
                    {{-- {{ $category->links() }} --}}
                </div>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('jQuery')
<script>
    $(document).ready(function(){
        $('.status').change(function(){
            $val = $(this).val();
            $parent = $(this).parents('tr');
            $productId = $parent.find('#pid').val();

            $.ajax({
                        type: 'get',
                        url: 'http://localhost/pizza_order_system/public/order/change/status',
                        dataType: 'json',
                        data:{
                            'status' : $val ,
                            'pid' : $productId
                        },
                    })
                    location.reload()

        })


    })
</script>

@endsection
