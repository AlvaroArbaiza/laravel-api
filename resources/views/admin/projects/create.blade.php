@extends('layouts.project')

{{-- Head | title --}}
@section('title')
    Laravel | Create
@endsection

{{-- Main Content --}}
@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container text-white">
    <div class="row justify-content-center my-5">
        <div class="col-9 p-5 border rounded bg-dark">

            <h2 class="mb-5">Inserisci tutti i campi per generare un nuovo progetto</h2>

            {{-- form --}}
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- title --}}
                <div class="mb-3">
                    <label for="project_title" class="form-label">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="project_title" name="title">
                    {{-- error --}}
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- description --}}
                <div class="mb-3">
                    <label for="project_description" class="form-label">Descrizione</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="project_description" rows="3" name="description"></textarea>
                    {{-- error --}}
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- customer --}}
                <div class="mb-3">
                    <label for="project_customer" class="form-label">Cliente</label>
                    <input type="text" class="form-control @error('customer') is-invalid @enderror" id="project_customer" name="customer">
                    {{-- error --}}
                    @error('customer')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- type customer --}}
                <div class="mb-3">
                    <label for="project_type_customer" class="form-label">Settore</label>
                    <input type="text" class="form-control @error('type_customer') is-invalid @enderror" id="project_type_customer" name="type_customer">
                    {{-- error --}}
                    @error('type_customer')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- price --}}
                <div class="mb-3">
                    <label for="project_price" class="form-label">Costo</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="project_price" name="price">
                    {{-- error --}}
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- created --}}
                <div class="mb-3">
                    <label for="project_created" class="form-label">Data</label>
                    <input type="date" class="form-control @error('created') is-invalid @enderror" id="project_created" name="created">
                    {{-- error --}}
                    @error('created')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- image --}}
                <div class="mb-3">
                    <label for="project_image" class="form-label">Immagine</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="project_image" name="image">
                    {{-- error --}}
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- video --}}
                <div class="mb-3">
                    <label for="project_video" class="form-label">Video</label>
                    <input type="file" class="form-control @error('video') is-invalid @enderror" id="project_video" name="video">
                    {{-- error --}}
                    @error('video')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- type --}}
                <div class="mb-3">
                    <label for="project_type" class="form-label">Tipologia</label>
                    <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="project_type">

                        <option disabled selected>Scegli Tipologia</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    {{-- error --}}
                    @error('type_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- technology --}}
                <div class="mb-3">
                    @foreach($technologies as $tech)
                        <div class="form-check @error('technology_id') is-invalid @enderror">

                            {{-- aggiungiamo le quadre "[]" al name per passare tutti i valori inviati come un array, cosi evitiamo che i valori si sovrascrivano tra loro, il nome del name può variare e non ha nessun legame perchè tanto quello che conta è il value passato --}}
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="{{ $tech->name }}" 
                                value="{{ $tech->id }}" 
                                name="technology_id[]"
                            >
                            <label class="form-check-label" for="{{ $tech->name }}">
                                {{ $tech->name }}
                            </label>
                        </div>
                    @endforeach  

                    {{-- error --}}
                    @error('technology_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror                  
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection