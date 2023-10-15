<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'listPage')
</head>

<body>
    @extends('admin.layout.master')
    @section('content')
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-lg-9 offset-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <button onclick="history.back()" class="btn btn-dark">Back</button>
                                    <h3 class="text-center title-2">Edit Product</h3>
                                </div>
                                <hr>
                       <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-5">
                            <div class="col-4 offset-1 mt-5">
                                <input type="hidden" name="pizzaId" value="{{$edit->id}}">

                                <img src="{{asset('storage/'.$edit->image)}}"  />


                                    <input id="cc-pament" name="pizzaImage" type="file" class="form-control "  >
                                    @error('pizzaImage')
                                        <small class="text-danger">{{ $message }} !</small>
                                    @enderror
                                    <div class="mt-5 ">
                                        <button class="btn btn-dark col-11" type="submit"> Update <i class="fa-solid fa-pen-to-square"></i></button>
                                     </div>
                                </div>
                                <div class="col-5 offset-1">
                                    <div class="mb-3">
                                        <label for="cc-payment" class="control-label ">Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text" class="form-control "  value="{{old('name',$edit->name)}}"  aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                        @error('pizzaName')
                                        <small class="text-danger">{{ $message }} !</small>
                                    @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="cc-payment" class="control-label ">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" type="number" class="form-control "  value="{{old('email',$edit->price)}}"  aria-required="true" aria-invalid="false" placeholder="Enter Email">
                                        @error('pizzaPrice')
                                        <small class="text-danger">{{ $message }} !</small>
                                         @enderror
                                    </div>
                                    <div class="mb-3 ">
                                        <select name="pizzaCategory" class="form-control" >
                                            <option value="">Choose Category </option>\
                                            @foreach ($category as $c )
                                            <option value="{{$c->id}}" @if ( $edit->id == $c->id) selected @endif >{{$c->name}}</option>

                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                        <small class="text-danger">{{ $message }} !</small>
                                       @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="cc-payment" class="control-label ">Description</label>
                                        <input id="cc-pament" name="pizzaDescription" type="text" class="form-control "  value="{{old('email',$edit->description)}}"  aria-required="true" aria-invalid="false" placeholder="Enter Email">
                                        @error('pizzaPrice')
                                        <small class="text-danger">{{ $message }} !</small>
                                         @enderror
                                    </div>


                                </div>
                            </div>


                        </div>
                       </form>
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
