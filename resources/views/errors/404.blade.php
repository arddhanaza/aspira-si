@extends('templates/template')

@section('title','ERROR 404')

@section('container')

<!-- <div style="height: 100%;width:100%"> -->
<!-- <div class="row align-items-center"> -->
<div class="col-md-6 " style="line-height : 100%;margin: 8% auto; ">
    <img draggable="true" style="
    display: block;
    margin:auto auto;" src="{{URL::to('/assets/img/404.png')}}" alt="Error 404">
    <div>
        <a href="{{ url('/') }}" type="button" class="btn btn-primary d-flex" name="backk">Back to Home</a>
    </div>
</div>

@endsection