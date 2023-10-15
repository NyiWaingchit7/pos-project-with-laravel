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
                                    <h3 class="text-center title-2">Edit Account</h3>
                                </div>
                                <hr>
                       <form action="{{route('account#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-5">
                            <div class="col-4 offset-1 mt-5">
                                @if (Auth::user()->imgae == null)
                                <img src="{{asset('image/userImage.png')}}" alt="Cool Admin" />
                                @else
                                <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" />
                                @endif
                                <div class="mb-3 col-12">

                                    <input id="cc-pament" name="image" type="file" class="form-control "  >
                                </div>
                             <div class="mt-5 ">
                                <button class="btn btn-dark col-11"> Update <i class="fa-solid fa-pen-to-square"></i></button>
                             </div>
                            </div>

                            <div class="col-6 offset-1">
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Name</label>
                                    <input id="cc-pament" name="name" type="text" class="form-control "  value="{{old('name',Auth::user()->name)}}"  aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                    @error('name')
                                    <small class="text-danger">{{ $message }} !</small>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Email</label>
                                    <input id="cc-pament" name="email" type="email" class="form-control "  value="{{old('email',Auth::user()->email)}}"  aria-required="true" aria-invalid="false" placeholder="Enter Email">
                                    @error('email')
                                    <small class="text-danger">{{ $message }} !</small>
                                     @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Phone </label>
                                    <input id="cc-pament" name="phone" type="number" class="form-control "  value="{{old('phone',Auth::user()->phone)}}" aria-required="true" aria-invalid="false" placeholder="Enter PhoneNumber">
                                    @error('phone')
                                    <small class="text-danger">{{ $message }} !</small>
                                   @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Address </label>
                                    <input id="cc-pament" name="address" type="text" class="form-control " value="{{old('address',Auth::user()->address)}}" aria-required="true" aria-invalid="false" placeholder="Enter Address">
                                    @error('address')
                                    <small class="text-danger">{{ $message }} !</small>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Role</label>
                                    <input id="cc-pament" name="oldPass" type="text" class="form-control " value="{{old('role',Auth::user()->role)}}"  aria-required="true" aria-invalid="false" placeholder="" disabled>
                                    @error('oldPass')
                                    <small class="text-danger">{{ $message }} !</small>
                                @enderror
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
