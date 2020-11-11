@extends('templates/template')

@include('templates.navbar')

@section('title','Aspiration')

@section('container')

    <section class="container  mt-5">
        <div class="row mb-4 justify-content-center">
            <div class="col-lg-10 col-md-10 col-sm-12 mb-4">
                <h5>
                    <a href="{{route('profile',session(0)->id_mahasiswa)}}"  style="border: none;background-color: transparent;"><img
                            style="width: 30px;" src="{{asset('assets/icon/arrow-left-short.svg')}}" alt="">Back
                    </a>
                </h5>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="card">
                    <form action="{{route('save_edit_password',session(0)->id_mahasiswa)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-header">
                            <h4>Edit Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" name="old_password" placeholder="Old Password" class="form-control" required id="confim_password">
                            </div>
                            <div class="dropdown-divider">

                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" placeholder="New Password" class="form-control" required id="new_password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required id="confirm_password">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary rounded-pill">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
    <!--End of Aspiration Card-->
        </div>
    </section>

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
