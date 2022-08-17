@extends('admin.layouts.master')

@section('title', 'Edit Product')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row me-2">
                    <div class="col-lg-2 offset-10 ">
                        <a href="{{ route('products#list') }}"><button class="btn bg-dark text-white my-3"><i
                                    class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mt-3">
                                <h3 class="fw-bold text-center title-2">Product</h3>
                            </div>
                            <hr>

                            <form action="{{route('products#update', $product->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-1 my-3">
                                        <img src="{{asset('storage/'.$product->image)}}" alt="">

                                        <div class="mt-3">
                                            <input type="file" accept="image/*" name="productImage" id="" class="form-control @error('productImage') is-invalid @enderror" >
                                            @error('image')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-5">
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block col-12">
                                                <span id="payment-button-amount">Update</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-5 offset-1 my-3">

                                        <input type="hidden" name="productID" value="{{$product->id}}">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="productName" type="text"
                                                value="{{ old('productName', $product->name) }}"
                                                class="form-control @error('productName') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false">

                                                @error('productName')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="productCategory" class="form-select @error('productCategory') is-invalid @enderror" id="">
                                                <option value="" disabled selected>Choose Product's Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>

                                                @error('productCategory')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>

                                            <div class="input-group">
                                                <input id="cc-pament" name="productPrice" type="number"
                                                value="{{ old('productPrice', $product->price) }}"
                                                class="form-control @error('productPrice') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false">

                                                <label for="" class="input-group-text">MMK</label>
                                            </div>

                                            @error('productPrice')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <div class="input-group">

                                                <input id="cc-pament" name="productWaitingTime" type="number"
                                                value="{{ old('productWaitingTime', $product->waiting_time) }}"
                                                class="form-control @error('productWaitingTime') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false">

                                                <label for="" class="input-group-text">Minutes</label>
                                            </div>
                                            @error('productWaitingTime')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="productDescription" id="" cols="30" rows="10" class="form-control @error('productDescription') is-invalid @enderror">{{ old('productDescription', $product->description) }}</textarea>
                                            @error('productDescription')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="" type="text"
                                                value="{{$product->view_count}}"
                                                class="form-control"
                                                aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="" type="text"
                                                value="{{$product->created_at->format('j-F-Y')}}"
                                                class="form-control"
                                                aria-required="true" aria-invalid="false" disabled>
                                        </div>

                                    </div>
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
