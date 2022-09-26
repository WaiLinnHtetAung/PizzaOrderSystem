@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                @foreach ($messages as $message)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <p>Message from - <b>{{strtoupper($message->name)}}</b></p>
                                <small class="muted">{{$message->email}}</small>
                            </div>

                            <div class="card-body">
                                <p>{{$message->message }}</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
