
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
                            <h2 class="title-1">Category List</h2>

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
                  @if ( count($category) != 0)

                  <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Created Date</th>

                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($category as $categories )
                      <tr class="tr-shadow ">
                        <td>{{ $categories->id }}</td>
                        <td>{{ $categories->name }}</td>
                        <td>{{ $categories->created_at->format('j F Y') }}</td>
                        <td>
                            <div class="table-data-feature">


                                <a href="{{route('editPage',$categories->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                </a>
                                <a href="{{route('category#delete',$categories->id)}}" method='get'>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>

                            </div>
                        </td>
                    </tr>

                      @endforeach

                    </tbody>
                </table>
                @else

                <h3 class="text-muted">There is no DATA..</h3>

                  @endif
                    <div class="mt-1">
                        {{ $category->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
    @endsection

