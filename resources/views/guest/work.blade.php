@extends('layouts.project')

@section('title')
    Laravel | Work
@endsection

@section('content')

<div class="container my-5">

    {{-- work --}}
    <div class="row row-gap-5">

        <h2 class="text-uppercase text-center text-white mb-5 fw-bold">work</h2>

        @foreach ($projects as $element)      
            <div class="col-6">

                {{-- card --}}
                <div class="card">
                    <img src="{{ asset('storage/' . $element->image) }}" class="card-img-top" alt="{{ $element['title'] }}">

                    {{-- card-body --}}
                    <div class="card-body">

                        {{-- title --}}
                        <a href="{{ route('guest.show', $element['slug'] ) }}" class="mb-2">
                            <h5 class="card-title fw-bold">
                                {{ $element['title'] }}
                            </h5>
                        </a>

                        {{-- technologies --}}
                        <h6 class="card-subtitle mb-2">
                            <span class="text-body-secondary text-uppercase">Linguaggio usato: </span>
                            @if($element->technology)
                                @foreach($element->technology as $elem)
                                    <span class="badge rounded-pill text-bg-success">
                                        {{ $elem->name }}
                                    </span>
                                @endforeach
                            @endif
                        </h6>

                        {{-- cliente --}}
                        <h6 class="card-subtitle mb-2">
                            <span class="text-body-secondary text-uppercase">Cliente: </span>
                            {{ $element['customer'] }}
                        </h6>

                        {{-- tipologia di cliente --}}
                        <h6 class="card-subtitle mb-2">
                            <span class="text-body-secondary text-uppercase">Settore: </span>
                            {{ $element['type_customer'] }}
                        </h6>

                        {{-- prezzo del progetto --}}
                        <h6 class="card-subtitle mb-2">
                            <span class="text-body-secondary text-uppercase">Costo: </span>
                            <span>€</span>
                            {{ $element['price'] }}
                        </h6>

                        {{-- data creazione --}}
                        <h6 class="card-subtitle mb-2">
                            <span class="text-body-secondary text-uppercase">Data: </span>
                            {{ $element['created'] }}
                        </h6>

                        <p class="card-text">{{ $element['description'] }}</p>                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection