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
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="{{ route('listPage') }}"><button class="btn bg-dark text-white my-3">Back</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                <form action="{{ route('pass#Change') }}" method="POST" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="cc-payment" class="control-label ">Old Password</label>
                                            <input id="cc-pament" name="oldPass" type="password" class="form-control "
                                                aria-required="true" aria-invalid="false" placeholder="Old passwor">
                                            @error('oldPass')
                                                <small class="text-danger">{{ $message }} !</small>
                                            @enderror
                                            @if (session('passmatch'))
                                                 <small class="text-danger">{{ session('passmatch') }} </small>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="cc-payment" class="control-label ">New Password</label>
                                            <input id="cc-pament" name="newPass" type="password" class="form-control "
                                                aria-required="true" aria-invalid="false" placeholder="New passwor">
                                            @error('newPass')
                                                <small class="text-danger">{{ $message }} !</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="cc-payment" class="control-label ">Confirm Password</label>
                                            <input id="cc-pament" name="confirmPass" type="password"
                                                class="form-control " aria-required="true" aria-invalid="false"
                                                placeholder="Confirm passwor">
                                            @error('confirmPass')
                                                <small class="text-danger">{{ $message }} !</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            Change
                                            <i class="fa-solid fa-key"></i>
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
