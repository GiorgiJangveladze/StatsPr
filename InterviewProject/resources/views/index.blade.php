@extends('layout.app')

@section('content')
<div class="container">
    <div class="home-contnet-wrapper">
        <div class="btn-wrapper"> 
            <a class="btn btn-warning btn-lg" href="#">Upload File</a>
        </div>
        <div class="btn-wrapper">
            <a class="btn btn-primary btn-lg" href="{{route('orders')}}">Statistic Page</a>
        <div>
    </div>
</div>
@endsection