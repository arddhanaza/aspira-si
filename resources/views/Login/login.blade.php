@extends('templates/template')

@section('title','Login')

@section('container')

    <div class="card container mt-5 col-6">
        <div class="card-body">
            <form action="{{route('login')}}" method="post">
                @csrf
                <label for="username">
                    Username
                </label>
                <input type="text" name="username" class="form-control" id="username">
                <label for="password">
                    Password
                </label>
                <input type="password" name="password" id="password" class="form-control">
                <br>
                <button type="submit"  class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

@endsection
