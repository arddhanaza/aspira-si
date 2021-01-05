@extends('templates/template')

@include('templates.navbar')

@section('title','User Management')

@section('container')
    @if(Session::has('message'))
        <div class="alert {{session('messageType')}} alert-dismissible fade show" role="alert" id="alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session("message")}}
        </div>
        {{session()->forget('message')}}
    @endif
    <section class="mt-5 container">
        <!--Start of Aspiration Card-->
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <div class="card aspiration-card-table">
                    <div class="card-header">
                        <h1>Data Entitas</h1>
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambahEntitas">Tambah</button>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped datTable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Entitas</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entitas as $ent)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$ent->nama_entitas}}</td>
                                    <td>{{$ent->username}}</td>
                                    <td>{{$ent->status}}</td>
                                    <td>
                                        <button class="btn btn-outline-danger mb-2" data-toggle="modal"
                                                data-target="#modalResetPasswordEntitas{{$ent->id_entitas}}">Reset Password
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-info mb-2" data-toggle="modal"
                                                data-target="#modalUpdateEntitas{{$ent->id_entitas}}">Update
                                        </button>
                                        <button class="btn btn-outline-danger mb-2" data-toggle="modal"
                                                data-target="#modalDeleteEntitas{{$ent->id_entitas}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mb-4 mt-5">
            <div class="col-12">
                <div class="card aspiration-card-table">
                    <div class="card-header">
                        <h1>Data Mahasiswa</h1>
                        <button class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modalTambahMahasiswa">Tambah</button>                        
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped datTable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Angkatan</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mahasiswa as $mhs)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$mhs->username}}</td>
                                    <td>{{$mhs->nama_mahasiswa}}</td>
                                    <td>{{$mhs->angkatan}}</td>
                                    <td>
                                        <button class="btn btn-outline-danger mb-2" data-toggle="modal"
                                                data-target="#modalResetPassword{{$mhs->id_mahasiswa}}">Reset Password
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-info mb-2" data-toggle="modal"
                                                data-target="#modalUpdate{{$mhs->id_mahasiswa}}">Update
                                        </button>
                                        <button class="btn btn-outline-danger mb-2"  data-toggle="modal"
                                                data-target="#modalDelete{{$mhs->id_mahasiswa}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Aspiration Card-->
    </section>


{{-- Modal Tambah Data Entitas --}}           
    <div class="modal fade" id="modalTambahEntitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"> 
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Entitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                       
                    <form action="{{route('tambahDataEntitas')}}" method="post">                
                        @csrf
                        <input type="hidden" name="id_entitas" value="{{$ent->id_entitas}}">
                        <div class="form-group">
                            <label for="nama_entitas">Nama</label>
                            <input type="text" class="form-control" id="nama_entitas" name="nama_entitas">
                        </div>
                        <div class="form-group">
                            <label for="username_entitas">Username</label>
                            <input type="text" class="form-control" id="username_entitas" name="username_entitas">
                        </div>
                        <div class="form-group">
                            <label for="username_entitas">Password</label>
                            <input type="password" class="form-control" id="password_entitas" name="password_entitas">
                        </div>
                        <div class="form-group">
                            <label for="status_entitas">Status</label>
                            <select name="status_entitas" id="status_entitas" class="custom-select">                            
                                <option value="Dosen">Dosen</option>
                                <option value="Laboratorium">Laboratorium</option>
                                <option value="Organisasi">Organisasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                            <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">Cancel</button>
                        </div>
                    </form>
                </div>        
            </div>
        </div>
    </div>

    

{{--    Modal Update Entitas--}}
    @foreach($entitas as $ent)
        <div class="modal fade" id="modalUpdateEntitas{{$ent->id_entitas}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Data {{$ent->nama_entitas}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Status: <span class="badge badge-pill badge-secondary">{{$ent->status}}</span></h6>
                        <hr>
                        <form action="{{route('updateDataEntitas',$ent->id_entitas)}}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id_entitas" value="{{$ent->id_entitas}}">
                            <div class="form-group">
                                <label for="nama_entitas">Nama</label>
                                <input type="text" class="form-control" id="nama_entitas" value="{{$ent->nama_entitas}}" name="nama_entitas">
                            </div>
                            <div class="form-group">
                                <label for="username_entitas">Username</label>
                                <input type="text" class="form-control" id="username_entitas" value="{{$ent->username}}" name="username_entitas">
                            </div>
                            <div class="form-group">
                                <label for="status_entitas">Status</label>
                                <select name="status_entitas" id="status_entitas" class="custom-select">
                                    <option value="{{$ent->status}}" disabled selected>
                                        {{$ent->status}}
                                    </option>
                                    <option value="Dosen">
                                        Dosen
                                    </option>
                                    <option value="Laboratorium">
                                        Laboratorium
                                    </option>
                                    <option value="Organisasi">
                                        Organisasi
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Update</button>
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalResetPasswordEntitas{{$ent->id_entitas}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reset Password {{$ent->nama_entitas}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Are You Sure?</h3>
                        <hr>
                        <form action="{{route('resetPasswordEntitas',$ent->id_entitas)}}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id_entitas" value="{{$ent->id_entitas}}">
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit">Yes</button>
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDeleteEntitas{{$ent->id_entitas}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data {{$ent->nama_entitas}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Are You Sure?</h3>
                        <hr>
                        <form action="{{route('hapusDataEntitas',$ent->id_entitas)}}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id_entitas" value="{{$ent->id_entitas}}">
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit">Yes</button>
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

{{-- Modal Tambah Mahasiswa --}}           
    <div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"> 
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                       
                    <form action="{{route('tambahDataMahasiswa')}}" method="post">                
                        @csrf
                        <input type="hidden" name="id_entitas" value="{{$ent->id_entitas}}">
                        <div class="form-group">
                            <label for="nama_entitas">Nama</label>
                            <input type="text" class="form-control" id="nama_mhs" name="nama_mhs">
                        </div>
                        <div class="form-group">
                            <label for="username_entitas">Username</label>
                            <input type="text" class="form-control" id="username_mhs" name="username_mhs">
                        </div>
                        <div class="form-group">
                            <label for="username_entitas">Password</label>
                            <input type="password" class="form-control" id="password_mhs" name="password_mhs">
                        </div>
                        <div class="form-group">
                            <label for="username_entitas">Angkatan</label>
                            <input type="text" class="form-control" id="angkatan_mhs" name="angkatan_mhs">
                        </div>                        
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                            <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">Cancel</button>
                        </div>
                    </form>
                </div>        
            </div>
        </div>
    </div>


{{--    Modal Update Mahasiswa--}}
    @foreach($mahasiswa as $mhs)
        <div class="modal fade" id="modalUpdate{{$mhs->id_mahasiswa}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Data {{$mhs->nama_mahasiswa}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                        
                        <form action="{{ route('updateDataMahasiswa', $mhs->id_mahasiswa) }}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id_mhs" value="{{$mhs->id_mahasiswa}}">
                            <div class="form-group">
                                <label for="nama_mhs">Nama</label>
                                <input type="text" class="form-control" id="nama_mhs" value="{{$mhs->nama_mahasiswa}}" name="nama_mhs">
                            </div>
                            <div class="form-group">
                                <label for="username_mhs">Username</label>
                                <input type="text" class="form-control" id="username_mhs" value="{{$mhs->username}}" name="username_mhs">
                            </div>
                            <div class="form-group">
                                <label for="angkatan_mhs">Angkatan</label>
                                <input type="text" class="form-control" id="angkatan_mhs" value="{{$mhs->angkatan}}" name="angkatan_mhs">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Update</button>
                                <button class="btn btn-outline-secondary btn-block" type="button">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalResetPassword{{$mhs->id_mahasiswa}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reset Password {{$mhs->nama_mahasiswa}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Are You Sure?</h3>
                        <hr>
                        <form action="{{route('resetPasswordMahasiswa',$mhs->id_mahasiswa)}}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id_mahasiswa" value="{{$mhs->id_mahasiswa}}">
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit">Yes</button>
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDelete{{$mhs->id_mahasiswa}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Data {{$mhs->nama_mahasiswa}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Are You Sure?</h3>
                        <hr>
                        <form action="{{route('hapusDataMahasiswa',$mhs->id_mahasiswa)}}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id_mahasiswa" value="{{$mhs->id_mahasiswa}}">
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit">Yes</button>
                                <button class="btn btn-outline-secondary btn-block" data-dismiss="modal" type="button">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
