@extends('layouts.project')

{{-- Head | title --}}
@section('title')
    Laravel | Project
@endsection

{{-- Main Content --}}
@section('content')

    {{-- project --}}
    <section class="container d-flex text-white bg-dark p-4 mt-5">

        {{-- projectbook --}}
        <div class="d-flex flex-column pe-5">

            <img src="{{ asset('storage/'.$project->image) }}" class="card-img-top" alt="...">

            {{-- title --}}
            <h4 class="text-uppercase fw-bold">{{ $project['title'] }}</h4>

            {{-- slug --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Slug Titolo: </span>
                {{ $project['slug'] }}
            </h6>

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

            {{-- tipologia di progetto --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Tipologia Progetto: </span>
                @if($project->type)
                    {{ $project->type->name }}
                @endif
            </h6>

            {{-- slug progetto --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Slug Tipologia Progetto: </span>
                @if($project->type)
                    {{ $project->type->slug}}
                @endif
            </h6>

            {{-- data creazione --}}
            <h6 class="card-subtitle mb-2">
                <span class="text-white-50">Data: </span>
                {{ $project['created'] }}
            </h6>

            <p class="card-text">{{ $project['description'] }}</p>

            <div class="d-flex justify-content-between">
                {{-- edit --}}
                {{-- bottone con rotta che riconduce all'id della tabella dell'elemento selezionato --}}
                <a href="{{ route('projects.edit', $project ) }}" class="btn btn-info fw-bold">Modifica</a>
    
                {{-- delete --}}
                {{-- Inserisco nell'attributo action la rotta destroy, passando la variabile $project['id'] per cancellare l'elemento corrente --}}
                <form action="{{ route('projects.destroy', $project['id']) }}" method="POST">
    
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger fw-bold"
                        onclick="return confirm('Sicuro di volere eliminare questo elemento?')"
                    >Cancella</button>
                </form>
            </div>
        </div>

    </section>
@endsection