
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
                        <h2 class="title-1">Users List</h2>

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
              @if ( count($userList) != 0)

              <table class="table table-data2">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody id="data">
                  @foreach ($userList as $u )
                  <tr class="tr-shadow ">
                    <td>
                        @if ($u->image == null)
                        @if (Auth::user()->gender == 'female')
                        <img src="{{asset('image/female.jpeg')}}" class="col-3" alt="Cool Admin" />
                        @else
                        <img src="{{asset('image/male.png')}}" class="col-3" alt="Cool Admin" />
                        @endif
                      @else
                      <img src="{{asset('storage/'.$u->image)}}" class="col-3"/>
                      @endif
                    </td>
                    <input type="hidden" class="usserId" id="userId" value="{{$u->id}}">
                    <td>{{$u->name}}</td>
                    <td>{{$u->address}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->phone}}</td>
                    <td>
                        <button class="item delete" id="delete" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                        </button>

                    </td>
                    <td>
                        <select  id="role" class="form-control crole">
                            <option value="admin" @if ($u->role == 'admin')  selected @endif >Admin</option>
                            <option value="user" @if ($u->role == 'user') selected @endif >User</option>
                        </select>
                    </td>
                </tr>

                  @endforeach

                </tbody>
            </table>
            @else

            <h3 class="text-muted">There is no DATA..</h3>

              @endif
                <div class="mt-1">
                    {{-- {{ $category->links() }} --}}
                </div>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('jQuery')
<script>
    $(document).ready(function(){
        $('.delete').click(function(){

            $parent = $(this).parents('tr');
            $userId = $parent.find('#userId').val();

            $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/order/user/delete',
                        dataType: 'json',
                        data:{
                            'userId' : $userId
                        },
                    })
                    location.reload()
        })
        $('.crole').change(function(){
           $role = $(this).val();
           $parent = $(this).parents('tr');
            $userId = $parent.find('#userId').val();
            $.ajax({
                        type: 'get',
                        url: '/pizza_order_system/public/order/change/role',
                        dataType: 'json',
                        data:{
                            'role' : $role,
                            'userId' : $userId
                        },
                    })
                    location.reload()
        })

    })
</script>

@endsection
