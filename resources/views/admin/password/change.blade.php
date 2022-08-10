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
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Current Password</label>v
                                <input id="cc-pament" name="currentPassword" type="password" class="form-control @session('notMatch') is-invalid @endsession @error('currentPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                 @error('currentPassword')
                                     <div class="invalid-feedback">{{$message}}</div>
                                 @enderror
                                 @if (session('notMatch'))
                                     <div class="invalid-feedback">{{session('notMatch')}}</div>
                                 @endif
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
