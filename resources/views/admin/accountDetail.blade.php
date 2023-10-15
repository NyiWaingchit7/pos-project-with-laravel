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
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button onclick="history.back()" class="btn btn-dark">Back</button>
                            <h3 class="text-center title-2">Account Detail</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2 offset-2 mt-3">
                                @if (Auth::user()->image == null)
                                <img src="{{ asset('image/download.png') }}" class="rounded-circle img-thumbnail"
                                alt="Cool Admin" />
                                @else
                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt="Cool Admin" class="rounded-circle img-thumbnail" />
                                @endif
                            </div>
                            <div class="col-6 offset-1 mt-3">
                                <h4 class="my-3"><i class="fa-solid fa-user"></i> : {{ Auth::user()->name}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-envelope"></i> : {{ Auth::user()->email}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-phone"></i> : {{ Auth::user()->phone}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-address-book"></i> : {{ Auth::user()->address}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-calendar-days"></i> : {{ Auth::user()->created_at->format('j-F-Y')}}</h4>


                            </div>
                            <div class="text-center mt-5">
                              <a href="{{route('account#editPage')}}">
                                <button class="btn btn-dark"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                              </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    @endsection
</body>
</html>
