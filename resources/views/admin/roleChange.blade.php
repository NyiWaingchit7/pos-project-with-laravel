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
                                    <h3 class="text-center title-2">Change User Role</h3>
                                </div>
                                <hr>
                       <form action="{{route('admin#roleChange',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-5">
                            <div class="col-4 offset-1 mt-5">
                                @if (Auth::user()->imgae == null)
                                <img src="{{asset('image/download.png')}}" alt="Cool Admin" />
                                @else
                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt="Cool Admin" />
                                @endif
                                <div class="mb-3 col-12">

                                    <input id="cc-pament" name="image" type="file" class="form-control "  disabled>
                                </div>
                             <div class="mt-5 ">
                                <button class="btn btn-dark col-11"> Change <i class="fa-solid fa-pen-to-square"></i></button>
                             </div>
                            </div>

                            <div class="col-6 offset-1">
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Name</label>
                                    <input id="cc-pament" name="name" type="text" class="form-control " disabled  value="{{old('name',$data->name)}}"  aria-required="true" aria-invalid="false" placeholder="Enter Name">

                                </div>
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Email</label>
                                    <input id="cc-pament" name="email" type="email" class="form-control " disabled  value="{{old('email',$data->email)}}"  aria-required="true" aria-invalid="false" placeholder="Enter Email">

                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Phone </label>
                                    <input id="cc-pament" name="phone" type="number" class="form-control " disabled  value="{{old('phone',$data->phone)}}" aria-required="true" aria-invalid="false" placeholder="Enter PhoneNumber">

                                </div>
                                <div class="mb-3">
                                    <label for="cc-payment" class="control-label ">Address </label>

                                </div>
                                <div class="mb-3"> Role
                                    <select name="role" id="" class="form-control">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
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
