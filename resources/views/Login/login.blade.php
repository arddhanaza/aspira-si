@extends('templates/template')

@section('title','Login')

@section('container')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/dist/css/login.css')}}">
@stop
    <div class="container h-100 align-content-center">
        <div class="row justify-content-center d-flex flex-lg-row-reverse h-100">
            <div class="col-md-6 align-self-center">
                <img draggable="false" src="{{URL::to('/assets/img/icon.png')}}" alt="icon aspirasi" width="100%">
            </div>
            <div class="col-md-6 align-self-center">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        <h1>ASPIRA <br>-SI</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username">NIM</label>
                                <input type="text" class="form-control rounded-pill shadow p-3 mb-1 bg-white rounded" id="username" name="username" style="border: none">
                            </div>
                            <div class="form-group">
                                <label for="password">PASSWORD</label>
                                <input type="password" name="password" class="form-control rounded-pill shadow p-3 mb-1 bg-white rounded" id="password" style="border: none">
                            </div>
                            <div class="form-group mt-5">
                                <button type="submit"  class="btn btn-primary btn-block shadow mb-1 ">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 d-flex justify-content-center mt-3">
                        <a href="{{route('lupa_password')}}">Forget Password</a>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
