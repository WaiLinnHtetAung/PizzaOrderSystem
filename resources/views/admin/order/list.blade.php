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

                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>

                    {{-- total category  --}}
                    <div class="h3 text-primary orderListTotal">
                        Total - {{count($orders)}}
                    </div>

                    {{-- <div class="table-data__tool-right">
                        <a href="{{ route('products#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div> --}}
                </div>

                {{-- created success message  --}}
                <div class="col-6 offset-6">
                    @if (session('createdProduct'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fa-solid fa-circle-check"></i>&nbsp;<span>{{session('createdProduct')}}</span>
                            <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                        </div>
                    @endif
                </div>

                {{-- deleted success message  --}}
                <div class="col-6 offset-6" id="delete-alert">
                    @if (session('deletedProduct'))
                        <div class="alert alert-warning alert-dismissible fade show">
                            <i class="fa-solid fa-circle-check"></i>&nbsp;<span>{{session('deletedProduct')}}</span>
                            <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                        </div>
                    @endif
                </div>

                {{-- updated product message  --}}
                <div class="col-6 offset-6">
                    @if (session('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fa-solid fa-thumbs-up me-2"></i>&nbsp;<span>{{session('updateSuccess')}}</span>
                        <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                    </div>
                    @endif
                </div>

                <div class="my-2">
                    <label for="" class="d-inline">Order Status - </label>
                    <select name="orderStatus" id="orderStatus" class="form-select col-2 d-inline">
                        <option value="all">All</option>
                        <option value="0">Pending</option>
                        <option value="1">Accept</option>
                        <option value="2">Reject</option>
                    </select>
                </div>

                {{-- @if (count($products) != 0 ) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orders as $order)
                                <tr>
                                    <input type="hidden" class="orderId" value="{{$order->id}}">
                                    <td>{{$order->user_id}}</td>
                                    <td>{{$order->user_name}}</td>
                                    <td>{{$order->created_at->format('F-j-Y')}}</td>
                                    <td>{{$order->order_code}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td>
                                        <select name="status" class="form-select changeStatus" >
                                            <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if($order->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if($order->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td>
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

@section('adminScripts')
    <script>
        $(document).ready(function() {
            $('#orderStatus').change(function() {
                $orderStatus = $('#orderStatus').val();

                $.ajax({
                    type : 'get',
                    url : "{{route('order#status')}}",
                    data : {
                        'status' : $orderStatus,
                    },
                    success : function(res) {
                        $list = '';
                        for($i = 0; $i < res.length; $i++) {

                            //date with js
                            $months=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                            $dbDate = new Date(res[$i].created_at);
                            $orderDate = $months[$dbDate.getMonth()]+'-'+$dbDate.getDate()+'-'+$dbDate.getFullYear();

                            if($orderStatus == 0 ) {
                                $status = `
                                    <select name="status" id="" class="form-select changeStatus">
                                        <option value="0"  selected>Pending</option>
                                        <option value="1" >Accept</option>
                                        <option value="2" >Reject</option>
                                    </select>
                                ` ;
                            } else if ($orderStatus == 1){
                                $status = `
                                    <select name="status" id="" class="form-select changeStatus">
                                        <option value="0"  >Pending</option>
                                        <option value="1" selected>Accept</option>
                                        <option value="2" >Reject</option>
                                    </select>
                                ` ;
                            } else if($orderStatus == 2) {
                                $status = `
                                    <select name="status" id="" class="form-select changeStatus">
                                        <option value="0" >Pending</option>
                                        <option value="1" >Accept</option>
                                        <option value="2" selected>Reject</option>
                                    </select>
                                ` ;
                            }

                            $list += `
                            <tr>
                                <input type="hidden" class="orderId" value="${res[$i].id}">
                                    <td>${res[$i].user_id}</td>
                                    <td>${res[$i].user_name}</td>
                                    <td>${$orderDate}</td>
                                    <td>${res[$i].order_code}</td>
                                    <td>${res[$i].total_price}</td>
                                    <td>${$status}</td>
                                </tr>
                            `;
                        }

                        $('#dataList').html($list);
                        $('.orderListTotal').html('Total - ' + res.length);
                    }
                })
            })

            // ---------change order status----------
            $(document).on('click', '.changeStatus', function(){
                $updatedStatus = $(this).val();

                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();

                $.ajax({
                    type : 'get',
                    url : "{{route('change#status')}}",
                    data : {
                        'status' : $updatedStatus,
                        'orderId' : $orderId,
                    },
                    success : function(res) {

                    }
                })
            })
        })
    </script>
@endsection


