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
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>

                    {{-- total category  --}}
                    <div class="h3 text-primary">
                        Total - {{$products->total()}}
                    </div>

                    <div class="table-data__tool-right">
                        <a href="{{ route('products#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
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

                {{-- passowrd changed message  --}}
                <div class="col-6 offset-6">
                    @if (session('passwordChanged'))
                    <div class="alert alert-warning alert-dismissible fade show">
                        <i class="fa-solid fa-thumbs-up me-2"></i>&nbsp;<span>{{session('passwordChanged')}}</span>
                        <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                    </div>
                    @endif
                </div>

                @if (count($products) != 0 )
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="tr-shadow">
                                <td class="col-1" ><img src="{{asset('storage/'.$product->image)}}" alt="" class="img-thumbnail shadow " ></td>
                                <td class="col-2">{{$product->name}}</td>
                                <td class="col-2">{{$product->price}}</td>
                                <td class="col-2">{{$product->category_id}}</td>
                                <td class="col-2">
                                    <div class="table-data-feature">
                                        <button onclick="location='{{route('products#detail', $product->id)}}'" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button  class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <button id="delete-btn" onclick="location='{{route('products#delete', $product->id)}}'" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>

                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$products->links()}}
                    </div>
                </div>
                <!-- END DATA TABLE -->

                @else
                    <h3 class="text-secondary text-center mt-5">There is no products</h3>
                @endif


            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


