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
                            <h3 class="text-center title-2">Product Detail</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2 offset-1 mt-3">
                                <img src="{{asset('storage/'.$view->image)}} " >
                            </div>
                            <div class="col-7 offset-1 mt-3">
                                <span class="my-3 btn btn-dark me-2"><i class="fa-solid fa-pizza-slice"></i> :{{$view->name}}</span>
                                <span class="my-3 btn btn-dark me-2"><i class="fa-solid fa-money-bill"></i> : {{ $view->price }}</span>
                                <span class="my-3 btn btn-dark me-2"><i class="fa-solid fa-eye"></i> : {{ $view->view_count}}</span>
                                <span class="my-3 btn btn-dark me-2"><i class="fa-solid fa-eye"></i> : {{ $view->category_name}}</span>
                                <span class="my-3 btn btn-dark me-2"><i class="fa-solid fa-calendar"></i> : {{ $view->created_at->format('j-F-Y')}}</span>

                                <div class="my-3">
                                    <div class=""><i class="fa-solid fa-book"></i> Description</div>
                                    <span class="text-muted"> {{ $view->description}}</span>
                                </div>


                            </div>
                            <div class="text-center mt-5">
                              <a href="{{route('product#edit',$view->id)}}">
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
