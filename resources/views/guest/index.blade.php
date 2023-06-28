@extends('layouts.project')

@section('title')
    Laravel | Dashboard
@endsection

@section('content')

    {{-- jumbotron --}}
    <section class="jumbotron mt-5 mx-5 py-5">
        <div class="d-flex flex-column">
        
            {{-- content --}}
            <div class="content d-flex align-items-center text-white">
                <h3 class="d-flex flex-column me-4">
                    <span>Web </span>
                    <div>
                        <span>Developer</span>
                        <i class="fa-solid fa-laptop-code ms-5"></i>
                    </div>
                </h3>
            </div>

            <hr class="border-white border-3 w-75 opacity-100">

            <div class="skills d-flex align-items-center gap-4 text-white fs-2">
                <span>Css</span>
                <span>-</span>
                <span>Javascript</span>
                <span>-</span>
                <span>Vue</span>
                <span>-</span>
                <span>Vite</span>
                <span>-</span>
                <span>Php</span>
                <span>-</span>
                <span>MySQL</span>
                <span>-</span>
                <span>Laravel</span>
            </div>
        </div>
    </section>
@endsection