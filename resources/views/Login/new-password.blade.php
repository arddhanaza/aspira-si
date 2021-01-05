@extends('templates/template')

@section('title','Forgot Password')

@section('container')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/dist/css/login.css')}}">
@stop
<div class="container h-100 ">
    <div class="row justify-content-center d-flex flex-lg-row-reverse h-100">
        <div class="col-md-6 align-self-center">
            <img draggable="false" src="{{URL::to('/assets/img/icon.png')}}" alt="icon aspirasi" width="90%">
        </div>
        <div class="col-md-6 align-self-center">
            <div class="card rounded text-center shadow" style="width: 18rem;">
                <div class="card-body" style="padding-bottom: 30%;">
                    <h5 class="card-title" style="color: #45A1E5;">ASPIRA-SI</h5>                    
                    <h6 class="card-subtitle mb-2">Change Password</h6>
                    <form method="POST" action="{{route('save_edit_lupa_password',$mahasiswa->id_mahasiswa)}}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id_mahasiswa" value="{{$mahasiswa->id_mahasiswa}}">
                        <div class="form-group text-left">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control bg-light" id="new_password" name="new_password" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" class="form-control bg-light" id="confirm_password"
                                   name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script !src="">
    var new_password = document.getElementById("new_password")
        , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(new_password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    new_password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

@endsection
