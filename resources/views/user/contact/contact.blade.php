@extends('user.layouts.master')

@section('content')
    <div class="container">
        <form action="{{route('contact#message')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="">Message</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    <button class="btn btn-block btn-warning">Send</button>
                </div>
            </div>
        </form>
    </div>
@endsection
