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

                            <h2 class="title-1">Admin List</h2>

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
                <div class="">
                    <a href="{{ route('listPage') }}"><button class="btn bg-dark text-white my-3">Back</button></a>
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
                  @if ( count($data) != 0)

                  <table class="table table-data2">
                    <thead>
                        <tr>
                            <th></th>
                            <th> Name</th>
                            <th>Phone</th>
                            <th>Address</th>


                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $d )
                      <tr class="tr-shadow ">
                        <td>
                              @if ($d->image == null)
                              <img src="{{asset('image/download.png')}}" class="col-2"/>
                            @else
                            <img src="{{asset('storage/'.$d->image)}}" class="col-2"/>
                            @endif
                        </td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->phone }}</td>
                        <td>{{$d->address}}</td>


                        <td>
                            <div class="table-data-feature">



                                @if ($d->id == Auth::user()->id)

                                @else
                                <a href="{{route('admin#delete',$d->id)}}" method='get'>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>

                                @endif
                                @if ($d->id == Auth::user()->id)

                                @else
                                <a href="{{route('admin#roleChangePage',$d->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Role Change">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>

                                @endif


                            </div>
                        </td>
                    </tr>

                      @endforeach

                    </tbody>
                </table>
                @else

                <h3 class="text-muted">There is no DATA..</h3>

                  @endif
                    <div class="mt-1">
                        {{ $data->links() }}
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
