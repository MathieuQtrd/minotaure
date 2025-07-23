@extends('layouts.app') {{-- appel du cadre de la page resources/views/layouts/app.blade.php --}}

@section('title', 'Nouveau devis') {{-- définition du titre de cette page --}}

@section('content')
<h1 class="pb-3 border-bottom">Demande de devis</h1>
    <div class="row">
        <div class="col-12">
            {{-- message de validation --}}
            @if(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif
        </div>
        <div class="col-6 mx-auto my-5 p-3 border">
        <form method="POST" action="{{ route('devis.store') }}" class="form">
            @csrf
            <div class="mb-3">
                <label for="name">Nom :</label>
                <input class="form-control"  type="text" name="name" id="name" value="{{ old('name') }}" required>
                {{-- message d'erreur --}}
                @error('name')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email">Email :</label>
                <input class="form-control"  type="email" name="email" id="email" value="{{ old('email') }}" required>
                {{-- message d'erreur --}}
                @error('email')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subject">Sujet :</label>
                <input class="form-control"  type="text" name="subject" id="subject" value="{{ old('subject') }}" required>
                {{-- message d'erreur --}}
                @error('subject')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="message">Message :</label>
                <textarea class="form-control" name="message" id="message" required>{{ old('message') }}</textarea>
                {{-- message d'erreur --}}
                @error('message')
                    <p class="alert alert-danger mt-3">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-dark text-white"  type="submit">Envoyer</button>
        </form>
        </div>
    </div>   
@endsection