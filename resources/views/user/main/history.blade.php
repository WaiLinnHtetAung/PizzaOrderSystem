@extends('user.layouts.master');

@section('content')
        <!-- Cart Start -->
        <div class="container-fluid" style="height: 400px;">
            <div class="row px-xl-5">
                <div class="col-lg-8 offset-2 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="dataTable">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->created_at->format('F-j-y')}}</td>
                                    <td>{{$order->order_code}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>
                                        @if ($order->status == 0)
                                            <span class="text-info"><i class="fa-solid fa-hourglass-start me-2"></i>Pending...</span>
                                        @elseif ($order->status == 1)
                                            <span class="text-success"><i class="fa-solid fa-check me-2"></i>Success</span>
                                        @elseif ($order->status == 3)
                                            <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">{{$orders->links()}}</div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection
