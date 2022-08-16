@extends('admin.layouts.master')

@section('title', 'Create Products')

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row me-2">
                <div class="col-3 offset-8">
                    <a href="{{route('products#list')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Products</h3>
                        </div>
                        <hr>
                        <form action="{{route('products#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Product Name</label>
                                <input id="cc-pament" name="productName" type="text" value="{{old('productName')}}" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product ...">
                                 @error('productName')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="productCategory" class="form-select @error('productCategory') is-invalid @enderror">
                                    <option value="" disabled selected>Choose product's category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                 @error('productCategory')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input type="file" name="productImage" accept="image/*" id="" class="form-control @error('productImage') is-invalid @enderror">
                                 @error('productImage')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea name="productDescription" id="" cols="30" rows="10" class="form-control @error('productDescription') is-invalid @enderror" placeholder="Enter Description ...">{{old('productDescription')}}</textarea>
                                 @error('productDescription')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input type="text" name="productWaitingTime" value="{{old('productWaitingTime')}}" id="" class="form-control @error('productWaitingTime') is-invalid @enderror" placeholder="Enter Waiting Time (min) ...">
                                 @error('productWaitingTime')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input type="text" name="productPrice" value="{{old('productPrice')}}" id="" class="form-control @error('productPrice') is-invalid @enderror" placeholder="Enter Price (mmk) ...">
                                 @error('productPrice')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
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
