@extends('templates/template')

@include('templates.navbar')

@section('title','Announcement')


@section('container')

    <section class="mt-5 container-fluid">
        <!--Start of Aspiration Card-->
        {{--loop--}}
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
    <!--End of Aspiration Card-->
    </section>
@endsection
