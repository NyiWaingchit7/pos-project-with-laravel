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
                    <a href="{{route('listPage')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Category</h3>
                        </div>
                        <hr>
                        <form action="{{route('category#edit',$edit->id)}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">

                               <input type="hidden" name="categoryID" value="{{ $edit->id }}">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="categoryName" type="text" value="{{old('categoryname',$edit->name)}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Edit category...">
                                @error('categoryName')
                                <small class="text-danger">{{$message}} !</small>

                                @enderror
                            </div>


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Edit</span>
                                    <i class="fa-solid fa-pen-to-square"></i>
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
