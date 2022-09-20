@extends('admin.layouts.master')

@section('title', 'Product List')

@section('search-bar')
    <form class="form-header" action="{{route('products#list')}}" method="get">
        <input class="au-input au-input--xl" type="text" name="search_product" value="{{request('search_product')}}" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">

                <a href="{{route('order#list')}}" class="text-dark mb-3"><i class="fa-solid fa-arrow-left me-2"></i>Back</a>

                <!-- DATA TABLE -->

                <div class="row col-6">
                    <div class="card mt-2">

                        <div class="card-body mt-1" style="border-bottom: 1px solid black;">
                            <h4>Order Info</h4>
                            <small class="text-info"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include delivery charges</small>
                        </div>

                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                <div class="col">{{strtoupper($orderItems[0]->user_name)}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-solid fa-hashtag me-2"></i>Order Code</div>
                                <div class="col">{{$orderItems[0]->order_code}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><i class="fa-regular fa-calendar-days me-2"></i>Order Date</div>
                                <div class="col">{{$orderItems[0]->created_at->format('F-j-Y')}}</div>
                            </div>
                            <div class="row">
                                <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i>Total Price</div>
                                <div class="col">{{$order->total_price}} MMK</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- @if (count($products) != 0 ) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                {{-- <th>User Name</th> --}}
                                <th>Product Image</th>
                                <th>Product Name</th>
                                {{-- <th>Order Date</th> --}}
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderItems as $orderItem)
                                <tr>
                                    <td class="align-middle">{{$orderItem->id}}</td>
                                    {{-- <td>{{$orderItem->user_name}}</td> --}}
                                    <td class="col-2"><img src="{{asset('storage/'.$orderItem->product_image)}}" alt="productimage" style="width: 100%;" class="img-thumbnail"></td>
                                    <td>{{$orderItem->product_name}}</td>
                                    {{-- <td>{{$orderItem->created_at->format('F-j-Y')}}</td> --}}
                                    <td>{{$orderItem->qty}}</td>
                                    <td>{{$orderItem->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{-- {{$orders->links()}} --}}
                    </div>
                </div>
                <!-- END DATA TABLE -->

                {{-- @else
                    <h3 class="text-secondary text-center mt-5">There is no products</h3>
                @endif --}}


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection



