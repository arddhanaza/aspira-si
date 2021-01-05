@extends('templates/template')

@section('title','Forgot Password')

@section('container')
    @if(Session::has('message'))
        <div class="alert {{session('messageType')}} alert-dismissible fade show" role="alert" id="alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session("message")}}
        </div>
        {{session()->forget('message')}}
    @endif
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/dist/css/login.css')}}">
@stop

<div class="container h-100 ">
    <div class="row justify-content-center d-flex flex-lg-row-reverse h-100">
        <div class="col-md-6 align-self-center">
            <img draggable="false" src="{{URL::to('/assets/img/icon.png')}}" alt="icon aspirasi" width="90%">
        </div>
        <div class="col-md-6 align-self-center">
            <div class="card p-2 rounded text-center shadow bg-white" style="width: 18rem;">
                <div class="card-body pb-5">
                    <h5 class="card-title" style="color: #45A1E5;">ASPIRA-SI</h5>
                    <br>
                    <h6 class="card-subtitle mb-2">Forgot Your Password?</h6>
                    <p>Don't worry! Just fill in your username and full name check and give you a chance to reset your
                        password.<br><br>
                    </p>

                    <hr>
                    <form method="POST" action="{{route('validate_lupa_password')}}">
                        @csrf
                        <div class="form-group text-left">
                            <label for="username">Username</label>
                            <input type="text" class="form-control bg-light" id="username" name="username" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="nama_mahasiswa">Full Name</label>
                            <input type="text" class="form-control bg-light" id="nama_mahasiswa" name="nama_mahasiswa"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Reset Password</button>
                        <a href="{{url('/')}}" class="btn btn-primary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
