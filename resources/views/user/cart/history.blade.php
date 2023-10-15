@extends('user.layout.master')



@section('content')



    <!-- Cart Start -->
    <div class="container-fluid" style="height: 600px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($history as $h )
                       <tr>
                        <td>{{$h->created_at}}</td>
                        <td>{{$h->order_code}}</td>
                        <td>{{$h->total_price}}</td>
                        @if ($h->status == 0)
                        <td class="text-warning">Pending..</td>
                        @elseif ($h->status == 1)
                        <td class="text-success">Success..</td>
                        @else
                        <td class="text-danger">Reject...</td>
                        @endif

                    </tr>
                       @endforeach
                    </tbody>
                </table>
                <div class="">
                    <div class="mt-1">
                        {{ $history->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection

