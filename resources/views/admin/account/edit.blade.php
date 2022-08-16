@extends('admin.layouts.master')

@section('title', 'Edit Profile')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row me-2">
                    <div class="col-lg-2 offset-10 ">
                        <a href="{{ route('admin#profile') }}"><button class="btn bg-dark text-white my-3"><i
                                    class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="fw-bold text-center title-2">Profile</h3>
                            </div>
                            <hr>

                            <form action="{{route('admin#update', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-1 my-3">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('admin/images/default_user.png') }}" class="img-thumbnail"
                                                alt="John Doe" />
                                        @else
                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail"
                                                alt="John Doe" />
                                        @endif

                                        <div class="mt-3">
                                            <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror" >
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
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                value="{{ old('name', Auth::user()->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false">

                                                @error('name')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false">

                                                @error('email')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false">

                                                @error('phone')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" id="" class="form-select  @error('gender') is-invalid @enderror">
                                                <option value="" disabled selected class="text-muted">Choose your gender</option>
                                                <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text"
                                                value="{{ old('role', Auth::user()->role) }}"
                                                class="form-control @error('newPassword') is-invalid @enderror"
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
