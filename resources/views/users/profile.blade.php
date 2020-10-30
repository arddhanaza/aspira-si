{{--NOT FINISHED--}}

@extends('templates/template')

@include('templates.navbar')

@section('title','Profile')

@section('container')
    <div class="jumbotron profile-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <img src="{{asset('assets/img/telkom.jpg')}}" alt="" class="img-thumbnail border-0 rounded-circle"
                         style="max-width: 200px">
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div style="bottom: 0;position: absolute;max-width: 100%">
                        <div class="row">
                            <h3>Nama User</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-12">
                                <img src="{{asset('assets/icon/card-text.svg')}}" class="" alt="">
                                <a href="">15 Aspirasi</a>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-12">
                                <img src="{{asset('assets/icon/pencil-fill.svg')}}" class="" alt="">
                                <a href="">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-10">
                {{--                ROW ASPIRASI--}}
                <div class="row mb-4">
                    <div class="col-10">
                        <div class="card aspiration-card">
                            <div class="card-header aspiration-card-header">
                                <div class="row">
                                    <div class="col-7">
                                        <h3>A</h3>
                                        <span class="span-time">Posted on September, A</span>
                                    </div>
                                    <div class="col-5 text-right">
                                        <button disabled class="btn rounded-pill btn-primary">Telah Diresolve</button>
                                        <button disabled class="btn btn-sm btn-outline-danger"><span><img
                                                    src="{{'assets/icon/hand-thumbs-down.svg'}}" class="img-icon"
                                                    alt="">- A</span>
                                        </button>
                                        <button disabled class="btn btn-sm btn-primary"><span><img
                                                    src="{{'assets/icon/hand-thumbs-up.svg'}}" class="img-icon" alt=""> + A</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body aspiration-card-body">
                                <div class="aspiration-card-body-content">
                                    <div class="row mb-4">
                                        <div class="col-1 col">
                                            <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg"
                                                 style="width: 50px">
                                        </div>
                                        <div class="col-11 col">
                            <span class="span-asal usernamePengirim">
                                A
                            </span>
                                            <br>
                                            <span class="span-tujuan">
                                Kepada: A
                            </span>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <p>
                                                A
                                            </p>
                                        </div>
                                        <div class="col-10">
                                            {{--                                            @if(isset($asp->file_name))--}}
                                            <a href="" class="btn btn-outline-info"
                                               data-target="#modalFileA" data-toggle="modal">File
                                                Pendukung</a>
                                            {{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                END OF ROW--}}
            </div>
            <div class="col-2">
                <h5>Tentang Saya</h5>
                <ul>
                    <li>Mahasiswa</li>
                    <li>Mahasiswa</li>
                    <li>Link</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
