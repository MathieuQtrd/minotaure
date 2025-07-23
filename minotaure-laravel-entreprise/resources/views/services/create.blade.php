@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <h1 class="pb-3 border-bottom">Ajouter un service</h1>
    <div class="row">
        <div class="col-md-6 mx-auto">

            @if(session('success'))
            <div class="alert alert-success my-3">{{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() AS $message)
                    <p class="mb-0">{{ $message }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('services.store') }}" class="form border p-3 my-5" method="post">
                @csrf
                <div class="mb-3">
                    <label for="service_name">Nom service</label>
                    <input type="text" name="service_name" id="" class="form-control" value="{{ old('service_name') }}">
                </div>
                <button type="submit" class="btn btn-outline-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection

