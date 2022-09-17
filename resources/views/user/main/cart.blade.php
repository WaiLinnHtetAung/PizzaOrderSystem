@extends('user.layouts.master');

@section('content')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>&nbsp;</th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="dataTable">
                            @foreach ($cartItems as $item)
                                <tr id="item">
                                    <td class="align-middle"><img style="width: 30px;" src="{{asset("storage/$item->image")}}" alt="" style="width: 50px;"></td>
                                    <td class="align-middle">{{$item->product_name}}
                                    <input type="hidden" class="productId" value="{{$item->product_id}}">
                                    <input type="hidden" class="userId" value="{{$item->user_id}}">
                                    </td>
                                    <td class="align-middle"><span id="price">{{$item->product_price}}</span> ks</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" >
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="cartQty" value="{{$item->qty}}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle" id="subtotal">{{$item->product_price * $item->qty}} ks</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-danger removeBtn" id="removeBtn"><i class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="subtotalPrice">{{$totalPrice}} ks</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">3000 ks</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalPrice">{{$totalPrice + 3000}}</h5>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="checkoutBtn">Proceed To Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function(e) {
                $parentNode = $(this).parents('tr');
                $price = $parentNode.find('#price').text();
                // $oldqty = Number($parentNode.find('#cartQty').val());
                $cartQty = Number($parentNode.find('#cartQty').val());

                $total = $price * $cartQty;

                $parentNode.find('#subtotal').html($total + ' ks');

                TotalPrice();

            })

            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                $price = $parentNode.find('#price').text();
                // $oldqty = Number($parentNode.find('#cartQty').val());
                $cartQty = $parentNode.find('#cartQty').val();

                $total = $price * $cartQty;

                if($cartQty>=0) {
                    $parentNode.find('#subtotal').html($total + 'ks');
                } else {
                    $parentNode.remove();
                }

                TotalPrice();
            })

            $('.removeBtn').click(function() {
                $parentNode = $(this).parents('tr');

                $parentNode.remove();

                TotalPrice();
            })

                // ---------get subtotal price---------

            function TotalPrice() {
                $subtotal =0;

                $('#dataTable tr').each(function(index, row) {
                    // console.log(row);  ==> get all tr within id=dataTable
                    $subtotal += Number($(row).find('#subtotal').text().replace('ks',''));

                    $('#subtotalPrice').html(`${$subtotal} ks`);
                    $('#finalPrice').html(`${$subtotal+3000} ks`);  //add with delivery fees

                })
            }


            $('#checkoutBtn').click(function() {

                $orderList = [];
                $random = Math.floor(Math.random() * 10000000001); //for same order code for all row

                $('#dataTable tr').each(function(index, row) {
                    $orderList.push({
                        'user_id' : $(row).find('.userId').val(),
                        'product_id' : $(row).find('.productId').val(),
                        'qty' : $(row).find('#cartQty').val(),
                        'total' : $(row).find('#subtotal').text().replace('ks', '')*1,
                        'order_code' : 'POS'+$random,
                    });
                })

                $.ajax({
                    type : 'get',
                    url : "{{route('product#order')}}",
                    data : Object.assign({}, $orderList),
                    success : function(res) {
                        if(res.status == 'success') {
                            alert(res.message);
                            window.location.href = "{{route('user#home')}}";
                        }
                    }
                })


            })

        })
    </script>
@endsection
