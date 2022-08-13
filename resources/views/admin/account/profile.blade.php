@extends('admin.layouts.master')

@section('title', 'Profile')

@section('content')
    <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row me-2 ">
                <div class="col-lg-3 offset-9 ">
                    <a href="{{route('admin#edit')}}" class="me-2"><button class="btn bg-primary text-white my-3"><i class="fa-solid fa-user-pen me-2"></i>Edit</button></a>

                    <a href="{{route('category#list')}}" ><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="fw-bold text-center title-2">Profile</h3>
                        </div>
                        <hr>

                        {{-- --------------profile updated message----------- --}}
                        @if (session('updateProfileSuccess'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fa-solid fa-thumbs-up me-2"></i>&nbsp;<span>{{session('updateProfileSuccess')}}</span>
                            <button type="button" data-bs-dismiss='alert' class="btn-close"></button>
                        </div>
                        @endif
`
                        <div class="row">
                            <div class="col-3 offset-1 my-3">
                                @if (Auth::user()->image == null)
                                    <img src="{{asset('admin/images/default_user.png')}}" class="img-thumbnail" alt="John Doe" />
                                @else
                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail" alt="John Doe" />
                                 @endif
                            </div>

                            <div class="col-5 offset-2 my-3">
                                <h4 class="mb-3"><i class="me-3 fa-solid fa-file-signature"></i> {{Auth::user()->name}}</h4>
                                <h4 class="mb-3"><i class="me-3 fa-solid fa-envelope"></i> {{Auth::user()->email}}</h4>
                                <h4 class="mb-3"><i class="me-3 fa-solid fa-phone"></i> {{Auth::user()->phone}}</h4>
                                <h4 class="mb-3"><i class="fa-solid fa-mars-and-venus me-3"></i>{{Auth::user()->gender}}</h4>
                                <h4 class="mb-3"><i class="me-3 fa-solid fa-address-card"></i> {{Auth::user()->address}}</h4>
                                <h4 class="mb-3"><i class="me-3 fa-solid fa-calendar"></i> {{Auth::user()->created_at->format('j-F-Y')}}</h4>
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
