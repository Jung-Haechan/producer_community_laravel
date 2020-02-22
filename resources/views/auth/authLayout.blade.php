@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 m-4">
            <div class="card">
                <div class="card-header text-light bg-dark ">@yield('card-header')</div>
                <div class="card-body">
                    @yield('card-body')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
