
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
                        <h2 class="title-1">Order List</h2>

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
            <div class="mb-3">
                <a href="{{route('order#list')}}" class="btn btn-dark">Back</a>
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
              @if ( count($orderdata) != 0)

              <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Product Price</th>
                        <th>Delivery cost</th>
                        <th>Total price</th>


                    </tr>
                </thead>
                <tbody id="data">
                  @foreach ($orderdata as $o )
                  <tr class="tr-shadow ">
                    <td class="col-2"><img src="{{asset('storage/'.$o->product_image)}}" class="col-10" ></td>
                    <td>{{$o->user_name}}</td>
                    <td>{{$o->product_name}} </td>
                    <td>{{$o->qty}} </td>
                    <td>{{$o->product_price}} kyats</td>
                    <td>5000 kyats</td>
                    <td>{{$o->total + 5000}} kyats</td>
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


@endsection
