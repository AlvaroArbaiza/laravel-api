@extends('layouts.project')

{{-- Head | title --}}
@section('title')
    Laravel | Work - Show
@endsection

{{-- Main Content --}}
@section('content')

    {{-- project --}}
    <section class="container d-flex text-white bg-dark p-4 mt-5">

        {{-- projectbook --}}
        <div class="d-flex flex-column pe-5">

            <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="{{ $project['title'] }}">

            {{-- title --}}
            <h4 class="text-uppercase fw-bold">{{ $project['title'] }}</h4>

            {{-- technologies --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Linguaggio usato: </span>
                @if($project->technology)
                    @foreach($project->technology as $elem)
                        <span class="badge rounded-pill text-bg-success">
                            {{ $elem->name }}
                        </span>
                    @endforeach
                @endif
            </h6>

            {{-- cliente --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Cliente: </span>
                {{ $project['customer'] }}
            </h6>

            {{-- tipologia di cliente --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Settore: </span>
                {{ $project['type_customer'] }}
            </h6>

            {{-- prezzo del progetto --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Costo: </span>
                <span>€</span>
                {{ $project['price'] }}
            </h6>

            {{-- data creazione --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Data: </span>
                {{ $project['created'] }}
            </h6>

            <p class="card-text">{{ $project['description'] }}</p>
        </div>

    </section>
@endsection