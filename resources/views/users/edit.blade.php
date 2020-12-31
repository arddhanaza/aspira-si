@extends('templates/template')

@include('templates.navbar')

@section('title','Aspiration')

@section('container')

    @if(Session::has('message'))
        <div class="alert {{session('messageType')}} alert-dismissible fade show" role="alert" id="alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session("message")}}
        </div>
        {{session()->forget('message')}}
    @endif


<section class="container  mt-5">
    <div class="row mb-4 justify-content-center">
        <div class="col-lg-10 col-md-10 col-sm-12 mb-4">
            <h5>
                <a href="{{route('profile',session(0)->id_mahasiswa)}}" style="border: none;background-color: transparent;"><img style="width: 30px;" src="{{asset('assets/icon/arrow-left-short.svg')}}" alt="">Back
                </a>
            </h5>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="card">
                <form action="{{route('save_edit_password',session(0)->id_mahasiswa)}}" method="post">
                    @method('put')
                    @csrf
                    <ul class="list-unstyled">
                        <li class="media m-5">
                            <img src="{{URL::to('/assets/img/lock.png')}}" class="mr-3" alt="...">
                            <div class="media-body">
                                <h3 class="mb-4">Edit Password</h3>
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <!-- <img src="{{asset('assets/icon/bell-fill.svg')}}" alt=""> -->
                                    <input type="password" name="old_password" placeholder="Old Password" class="form-control " required id="confim_password" size="10">
                                </div>
                                <div class="dropdown-divider">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <!-- <i class="fas fa-lock prefix"></i> -->
                                    <input type="password" name="new_password" placeholder="New Password" class="form-control" required id="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required id="confirm_password">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary rounded-pill">Update Password</button>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <!-- =========CARD BODY========== -->
                    <!-- <div class="card-header">
                        <h4>Edit Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" placeholder="Old Password" class="form-control" required id="confim_password" size="30">
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
                    </div> -->
                    <!-- =========END FOOTER CARD========== -->
                </form>
            </div>
        </div>
        <!--End of Aspiration Card-->
    </div>
</section>

<script !src="">
    var new_password = document.getElementById("new_password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (new_password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    new_password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
@endsection
