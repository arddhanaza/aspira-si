@extends('templates/template')

@section('title','Forgot Password')

@section('container')    

<div class="col-md-12 d-flex justify-content-center" style="margin-top: 5%;">
<div class="card rounded text-center" style="width: 18rem;">
  <div class="card-body" style="padding-bottom: 30%;">
    <h5 class="card-title" style="color: #45A1E5;">ASPIRA-SI</h5>
    <br>
    <h6 class="card-subtitle mb-2">Forgot Your Password?</h6>
    <p >Don't worry! Just fill in your email we'll send you a link to reset your password.<br><br></p>        
    <form method="post">
        <div class="form-group text-left">
            <label for="email">Email Address</label>
            <input type="email" class="form-control bg-light" id="email" >            
        </div>  
        <button type="submit" class="btn btn-secondary">Send password reset email</button>
    </form>    
  </div>
</div>
</div>

@endsection