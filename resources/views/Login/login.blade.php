@extends('templates/template')

@section('title','Login')

@section('container')    
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-6" style="margin-top: 10%;">
        <div class="row">
            <div class="col-md-9 d-flex justify-content-end" >
                <h1>ASPIRA <br>-SI</h1>
            </div>            
        </div>        

        <div class="row">
            <div class="col-md-10 d-flex justify-content-end">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="username">NIM</label>
                        <input type="text" class="form-control shadow p-3 mb-1 bg-white rounded" id="username" name="username">
                    </div>                
                    <div class="form-group">
                        <label for="password">PASSWORD</label>
                        <input type="password" name="password" class="form-control shadow p-3 mb-1 bg-white rounded" id="password">
                    </div>                                
                    <button type="submit"  class="btn btn-primary btn-block shadow p-1 mb-1 ">Login</button>
                </form>                
            </div>            
        </div>         
        
        <div class="row">
            <div class="col-md-9 d-flex justify-content-end">
                <a href="forgot-password">Forget Password</a>
            </div>
        </div>
    </div>    

    <div class="col-md-6">
        <img src="{{URL::to('/assets/img/icon.png')}}" alt="icon aspirasi" width="70%">
    </div>
    </div>
    </div>
            


@endsection
