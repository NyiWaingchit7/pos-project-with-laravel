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
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Category Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                @error('pizzaName')
                                <small class="text-danger">{{$message}} !</small>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <input id="cc-pament" name="pizzaDescription" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Description...">
                                @error('pizzaDescription')
                                <small class="text-danger">{{$message}} !</small>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input id="cc-pament" name="pizzaImage" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                @error('pizzaImage')
                                <small class="text-danger">{{$message}} !</small>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <select name="pizzaCategory" class="form-control">
                                    <option value="">Choose Category..</option>
                                    @foreach ($category as $c )
                                        <option value="{{$c->id}}"> {{$c->name}}</option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                <small class="text-danger">{{$message}} !</small>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="pizzaPrice" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                @error('pizzaPrice')
                                <small class="text-danger">{{$message}} !</small>
                                @enderror
                            </div>



                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
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
