@extends('templates/template')

@include('templates.navbar')

@section('title','User Management')

@section('container')
<div class="alert alert-success" role="alert">
    Berhasil Reset Password nama_Entitas/Mahasiswa
</div>
<div class="alert alert-success" role="alert">
    Berhasil Hapus data nama_Entitas/Mahasiswa
</div>
<div class="alert alert-success" role="alert">
    Berhasil Update data nama_Entitas/Mahasiswa
</div>
<div class="alert alert-success" role="alert">
    Berhasil Menambahkan data nama_Entitas/Mahasiswa
</div>

    <section class="mt-5 container">
        <!--Start of Aspiration Card-->
        <div class="row justify-content-center mb-4">
            <div class="col-12">
                <div class="card aspiration-card-table">
                    <div class="card-header">
                        <h1>Data Entitas</h1>
                        <button class="btn btn-sm btn-success">Tambah</button>
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
                        <button class="btn btn-sm btn-success">Tambah</button>
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
                                        <button class="btn btn-outline-danger mb-2" disabled data-toggle="modal"
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

{{--    --}}{{--    Modal Update Mahasiswa--}}
{{--    @foreach($mahasiswa as $mhs)--}}
{{--        <div class="modal fade" id="modalUpdate{{$ent->id_entitas}}" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="exampleModalCenterTitle"--}}
{{--             aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="exampleModalLongTitle">Update Data {{$ent->nama_entitas}}</h5>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <h6>Status: <span class="badge badge-pill badge-secondary">{{$ent->status}}</span></h6>--}}
{{--                        <hr>--}}

{{--                        <form action="" method="post">--}}
{{--                            @method('put')--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="rowData" value="">--}}
{{--                            <div class="form-group">--}}
{{--                                <button class="btn btn-primary btn-block" type="submit">Update</button>--}}
{{--                                <button class="btn btn-primary btn-block" type="button">Cancel</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
