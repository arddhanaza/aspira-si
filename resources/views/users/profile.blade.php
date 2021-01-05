{{--NOT FINISHED--}}

@extends('templates/template')

@include('templates.navbar')

@section('title','Profile')

@section('container')

<div class="jumbotron profile-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-md-6">
                <img src="{{asset('assets/img/telkom.jpg')}}" alt="" class="img-thumbnail border -0 rounded-circle" style="max-width: 200px">
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div style="bottom: 0;position: absolute;max-width: 100%">
                    <div class="row">
                        <h3>{{$mhs->nama_mahasiswa}}</h3>
                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-12">
                            <img src="{{asset('assets/icon/card-text.svg')}}" class="" alt="">
                            <a disabled="">{{$aspirasi_mhs->count()}} Aspirasi</a>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-12">
                            <img src="{{asset('assets/icon/pencil-fill.svg')}}" class="" alt="">
                            <a href="{{route('edit_password',session(0)->id_mahasiswa)}}">Edit Password</a>
                        </div>
                    </div> -->
                    <ul class="list-unstyled">
                        <li class="media mt-2">
                            <img src="{{asset('assets/icon/card-text.svg')}}" class="" alt="">
                            <a disabled="">{{$aspirasi_mhs->count()}} Aspirasi</a>

                            <div class="ml-5"></div>

                            <img src="{{asset('assets/icon/pencil-fill.svg')}}" class="" alt="">
                            <a href="{{route('edit_password',session(0)->id_mahasiswa)}}">Edit Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!$aspirasi_mhs->isEmpty())
<div class="container">
    <div class="row">
        <div class="col-8">
            {{-- ROW ASPIRASI--}}
            @foreach($aspirasi_mhs as $aspirasi_mahasiswa)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card aspiration-card aspiration-card-profile">
                        <div class="card-header aspiration-card-header">
                            <div class="row">
                                <div class="col-7">
                                    <h3>{{$aspirasi_mahasiswa->judul_aspirasi}}</h3>
                                    <span class="span-time">Posted on September, {{$aspirasi_mahasiswa->created_at}}</span>
                                </div>
                                
                                <div class="col-5 text-right">
                                    <button disabled class="btn rounded-pill btn-primary">{{$aspirasi_mahasiswa->status}}
                                    </button>
                                    <button disabled class="btn btn-sm btn-outline-danger"><span><img src="{{'assets/icon/hand-thumbs-down.svg'}}" class="img-icon" alt="">{{$aspirasi_mahasiswa->downvote}}</span>
                                    </button>
                                    <button disabled class="btn btn-sm btn-primary"><span><img src="{{'assets/icon/hand-thumbs-up.svg'}}" class="img-icon" alt=""> +{{$aspirasi_mahasiswa->upvote}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body aspiration-card-body">
                            <div class="aspiration-card-body-content">
                                <div class="row mb-4">
                                    <div class="col-1 col">
                                        <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg" style="width: 50px">
                                    </div>
                                    <div class="col-11 col">
                                        <span class="span-asal usernamePengirim">
                                            {{$aspirasi_mahasiswa->nama_mahasiswa}}
                                        </span>
                                        <br>
                                        <span class="span-tujuan">
                                            Kepada: {{$aspirasi_mahasiswa->nama_entitas}}
                                        </span>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-10">
                                        <p>
                                            {{$aspirasi_mahasiswa->aspirasi_text}}
                                        </p>
                                    </div>
                                    <div class="col-10">
                                        @if(isset($aspirasi_mahasiswa->file_name))
                                        <a href="" class="btn btn-outline-info" data-target="#modalFile{{$aspirasi_mahasiswa->id_aspirasi}}" data-toggle="modal">File Pendukung</a>
                                        @endif
                                        @if($aspirasi_mahasiswa->status == 'Belum Diproses')
                                        <a href="" class="btn btn-outline-info" data-target="#modalupdate{{$aspirasi_mahasiswa->id_aspirasi}}" data-toggle="modal">Update</a>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- END OF ROW--}}
        </div>
        @else
            <div class="container col-7 col-md-9">
            <div class="text-center">
            <p>Tidak ada aspirasi</p>
            </div>
        @endif
        <div class="col-4">
            <div style="background-color: #4d9eda; border-radius:15px;margin: 20px 0px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <h5 style="padding:15px;color:white">Tentang Saya</h5>
            </div>
            <div class="card primary mb-3" style="max-width: 24rem; border-radius: 15px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-body" style="background-image: url({{URL::to('/assets/img/bgg.png')}});border-radius: 15px">
                    <h5 class="card-title" >{{$mhs->nama_mahasiswa}}</h5>
                    <p class="card-text" ><i>" Hi... saya {{$mhs->nama_mahasiswa}}, mahasiswa S1 Sistem Informasi Telkom University angkatan {{$mhs->angkatan}} "</i></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" style="background-color:inherit;">Nama : {{$mhs->nama_mahasiswa}}</li>
                        <li class="list-group-item" style="background-color:inherit;">NIM  : {{$mhs->username}}</li>
                        <li class="list-group-item" style="background-color:inherit;">Angkatan : {{$mhs->angkatan}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($aspirasi_mhs as $asp)
@if(isset($asp->file_name))
<div aria-hidden="true" aria-labelledby="modalFile{{$asp->id_aspirasi}}" class="modal fade" id="modalFile{{$asp->id_aspirasi}}" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">File Pendukung</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Download</span> <br>
                <?php
                foreach (json_decode($asp->file_name) as $file) { ?>
                    <a href="{{asset('files/'.$file)}}" target="_blank" class="btn btn-outline-info">Name: <?php echo $file ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
@endif

@endforeach
{{--    Modal Update Aspirasi--}}
    @foreach($aspirasi_mhs as $aspirasi_mahasiswa)
        <div class="modal fade" id="modalupdate{{$aspirasi_mahasiswa->id_aspirasi}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Aspirasi {{$mhs->nama_mahasiswa}}</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update',$aspirasi_mahasiswa->id_aspirasi)}}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id_aspirasi" value="{{$aspirasi_mahasiswa->id_entitas}}" id="id_mahasiswa">
                            <input type="hidden" name="id_entitas" value="{{$aspirasi_mahasiswa->id_entitas}}">
                            <div class="form-group">
                                <label for="judulAspirasi">Judul Aspisrasi</label>
                                <input type="text" class="form-control" id="judulAspirasi" value="{{$aspirasi_mahasiswa->judul_aspirasi}}" name="judul_aspirasi">
                            </div>
                            <div class="form-group">
                                <label for="">Tujuan Aspirasi</label>
                                <input type="text" class="form-control" id="tujuanAspirasi" value="{{$aspirasi_mahasiswa->nama_entitas}}" name="">
                            </div>
                            <div class="form-group">
                                <label for="">Teks Aspirasi</label>
                                <input type="text" class="form-control" id="tujuanAspirasi" value="{{$aspirasi_mahasiswa->aspirasi_text}}" name="">
                            </div>
                            <label for="file">File Pendukung</label>
                            <input class="form-control-file" id="file" multiple type="file" name="file_name[]" value="">
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Update</button>
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">Cancel</button>
                            </div>
                        </form>
                        </div>

                        

        @endforeach

@endsection