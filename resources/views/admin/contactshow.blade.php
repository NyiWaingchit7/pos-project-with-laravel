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
                            <h2 class="title-1">Review Messages</h2>

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
@if (count($message) != 0)

<div class="row">
    @foreach ($message as $m )
    <div class="col-5 offset-1">

    <div class="card border-light "  style="height:350px">
        <div class="card-header ">
           <h5 class="mb-3"> Name - {{$m->name}}</h5>
           <h5 class=""> Email - {{$m->email}}</h5>
        </div>
        <div class="card-body text-center">{{$m->message}}</div>
        <div class="card-footer text-center"><a href="{{route('message#delete',$m->contact_id)}}" class="btn btn-danger">Delete</a></div>
    </div>
    </div>

  @endforeach

</div>
@else
<h3 class="text-danger mt-5 p-5">There is no User Message .....</h3>

@endif

                </div>

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    @endsection
</body>
</html>
