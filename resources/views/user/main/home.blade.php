@extends('user.layouts.master');

@section('content')
        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Sidebar Start -->
                <div class="col-lg-3 col-md-4">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 pt-2">
                                <label class="" for="price-all">Category</label>
                                <span class="badge border font-weight-normal mb-2">{{count($categories)}}</span>
                            </div>
                            <hr>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{route('user#home')}}" class="text-dark"><label class="" for="price-all">All</label></a>
                                {{-- <span class="badge border font-weight-normal">{{count($categories)}}</span> --}}
                            </div>

                            @foreach ($categories as $category)
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <a href="{{route('filter#category', $category->id)}}" class="text-dark"><label class="" for="price-all">{{$category->name}}</label></a>
                                    {{-- <span class="badge border font-weight-normal">{{count($categories)}}</span> --}}
                                </div>
                            @endforeach
                        </form>
                    </div>
                    <!-- Price End -->

                    <div class="">
                        <button class="btn btn btn-warning w-100">Order</button>
                    </div>
                    <!-- Size End -->
                </div>
                <!-- Shop Sidebar End -->


                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <a href="{{route('cart#items')}}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-dark"></i>
                                <span class="badge text-dark border border-secondary rounded-circle" style="padding-bottom: 2px;">{{count($cart)}}</span>
                            </a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                    <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <select name="sorting" id="sorting" class="form-select">
                                            <option value="" selected disabled>Sort by <i class="fa-solid fa-arrow-down"></i></option>
                                            <option value="asc">Low Price to High</option>
                                            <option value="desc">High Price to Low</option>
                                        </select>
                                    </div>
                                    <div class="btn-group ml-2">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">10</a>
                                            <a class="dropdown-item" href="#">20</a>
                                            <a class="dropdown-item" href="#">30</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{-- ------products---------  --}}
                            <span id="product-list" class="row">
                                @if (count($products) != 0)
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <img class="img-fluid w-100" style="height: 210px;" src="{{asset('storage/'.$product->image)}}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{route('product#detail', $product->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate" href="">{{$product->name}}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                        <h5>{{$product->price}} Kyats</h5>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                        <small class="fa fa-star text-primary mr-1"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center bg-warning col-6 fs-4 offset-3 shadow py-3">There is no pizza.</p>
                                @endif
                            </span>

                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#sorting').change(function() {
                $sortData = $('#sorting').val();

                if($sortData == 'asc') {
                    $.ajax({
                        type : 'get',
                        url : 'http://localhost:8000/user/sort/list',
                        data : {'status' : 'asc'},
                        dataType : 'json',
                        success : function(response) {
                            $list = '';

                            for($i=0;$i<response.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 210px;" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                <h5>${response[$i].price} Kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;

                                $('#product-list').html($list);
                            }
                        }
                    });
                } else if($sortData == 'desc') {
                    $.ajax({
                        type : 'get',
                        url : 'http://localhost:8000/user/sort/list',
                        data : {'status':'desc'},
                        dataType : 'json',
                        success : function(response) {
                            $list = '';

                            for($i=0;$i<response.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 210px;" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                                <h5>${response[$i].price} Kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;

                                $('#product-list').html($list);
                            }
                        }
                    });
                }
            })

        });
    </script>
@endsection
