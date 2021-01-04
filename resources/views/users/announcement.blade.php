@extends('templates/template')

@include('templates.navbar')

@section('title','Announcement')


@section('container')

    <section class="mt-5 container-fluid">
        <!--Start of Aspiration Card-->
        <div class="row justify-content-center mb-4">
            <div class="col-10">
                <div class="card aspiration-card-table">
                    <div class="card-body table-responsive">
                        <table class="table table-striped datTable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Annoucement</th>
                                <th>File Pendukung</th>
{{--                                <th>Nama File</th>--}}
                                <th>Issue Terkait</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcements as $anc)
                            <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$anc->announcement_text}}</td>
                                    <td>
                                        @if(isset($asp->file_name))
                                            <a href="" class="btn btn-outline-info" data-target="#modalFile{{$asp->id_aspirasi}}" data-toggle="modal">File
                                                Pendukung</a>
                                        @else
                                            <span>Tidak Ada File Pendukung</span>
                                        @endif
                                    </td>    
                                    <td>{{$anc->judul_aspirasi}}</td>
                                    <td>{{$anc->created_at}}</td>

                            @endforeach
        <!--{{--loop--}}
        @foreach($announcements as $anc)
            <div class="row justify-content-center mb-4">
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Oleh : {{$anc->nama_entitas}}
                            </h5>
                            <h5>
                                Terkait : {{$anc->judul_aspirasi}}
                            </h5>
                            <span>Waktu: {{$anc->created_at}}</span>
                        </div>
                        <div class="card-body">
                            <p>
                                {{$anc->announcement_text}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
    End of Aspiration Card
    </section>
@endsection


