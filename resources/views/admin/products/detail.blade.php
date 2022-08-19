@extends('admin.layouts.master')

@section('title', 'Product Detail')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row me-2 ">
                    <div class="col-lg-2 offset-10 ">
                        {{-- <a href="{{ route('admin#edit') }}" class="me-2"><button class="btn bg-primary text-white my-3"><i
                                    class="fa-solid fa-user-pen me-2"></i>Edit</button></a> --}}

                        <button class="btn bg-dark text-white my-3" onclick="history.back()"><i class="fa-solid fa-arrow-left me-2"></i>Back</button>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="card-title">
                                <h3 class="fw-bold text-center title-2">Detail</h3>
                            </div>
                            <hr> --}}

                            {{-- --------------profile updated message----------- --}}
                            @if (session('updateProfileSuccess'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i
                                        class="fa-solid fa-thumbs-up me-2"></i>&nbsp;<span>{{ session('updateProfileSuccess') }}</span>
                                    <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                                </div>
                            @endif
                            `
                            <div class="row">
                                <div class="col-3 ms-5 my-3">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail" alt="">

                                </div>

                                <div class="col-7 offset-1 mb-5 mt-2">
                                    <h2 class="mb-5">{{ $product->name }} &nbsp;&nbsp; <span class="h5"><i class="fa-solid fa-layer-group me-2"></i>{{ $product->category_name }}</span> </h2>
                                    <div class="mb-4">
                                        <span class="h5 btn bg-dark text-white" title="price"><i class="fa-solid fa-money-bill-1-wave me-2"></i>{{ $product->price }} MMK</span>
                                        <span class="h5 btn bg-dark text-white" title="waiting time"><i class="fa-solid fa-eye me-2"></i>{{ $product->waiting_time }} minus</span>
                                        <span class="h5 btn bg-dark text-white" title="view"><i class="fa-solid fa-eye me-2"></i>{{ $product->view_count }}</span>
                                        <span class="h5 btn bg-dark text-white"><i class="me-2 fa-solid fa-calendar"></i>{{ $product->created_at->format('j-F-Y') }}</span>
                                    </div>
                                    <h4 class="mb-3 h5"><i class="fa-solid fa-file-lines me-2 h4"></i>Details</h4>
                                    <span> {{ $product->description }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
