@extends('admin.layouts.master')

@section('title', 'Change Password')

@section('content')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row me-2 ">
                <div class="col-3 offset-8 ">
                    <a href="{{route('category#list')}}" ><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>

                        {{-- password not match message --}}
                        <div class="col-12 ">
                            @if (session('notMatch'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i>&nbsp;<span>{{session('notMatch')}}</span>
                                    <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                                </div>
                            @endif
                        </div>


                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Current Password</label>v
                                <input id="cc-pament" name="currentPassword" type="password" class="form-control @error('currentPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                 @error('currentPassword')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror

                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                 @error('newPassword')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                 @error('confirmPassword')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key me-2"></i>
                                    <span id="payment-button-amount">Change Password</span>

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
