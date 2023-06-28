@extends('layouts.project')

@section('title')
    Laravel | Types
@endsection

@section('content')
    <div class="container my-5">
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->slug }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection