<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   @section('title','listPage')
</head>
<body>
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
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#add')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Products
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
                        <form action="{{route('product#list')}}" class="d-flex " method="get">
                            <input type="text" name="key" placeholder="  Serach data.." value="{{request('key')}}">
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
                @if (session('delete'))
                <div class="alert alert-warning alert-dismissible fade show col-5 offset-7" role="alert">
                    <small>{{ session('delete') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if (session('passchange'))
                <div class="alert alert-success alert-dismissible fade show col-5 offset-7" role="alert">
                    <small>{{ session('passchange') }}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="table-responsive table-responsive-data2 mt-3">

                @if (count($product) != 0)

                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="text-center">Image</th>
                            <th> Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th><i class="fa-solid fa-eye"></i></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>

                      @foreach ($product as $p )
                      <tr class="tr-shadow ">

                        <td class=''><div class="text-center" style="height: 150px"><img src="{{asset('storage/'.$p->image)}} " class="h-100"  ></div></td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->category_name }}</td>
                        <td>{{$p->price}} Kyats</td>
                        <td>{{$p->view_count}}</td>
                        <td>
                            <div class="table-data-feature">

                                <a href="{{route('product#view',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{route('product#edit',$p->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{route('product#delete',$p->id)}}" method='get'>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>

                            </div>
                        </td>
                    </tr>

                      @endforeach



                    </tbody>
                </table>
                @else
                <h3 class="text-secondry mt-5">There is no Data..</h3>
                     @endif
                <div class="mt-1">
                    {{ $product->links() }}
                </div>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    @endsection
</body>
</html>
