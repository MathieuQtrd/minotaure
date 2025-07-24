@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <h1 class="pb-3 border-bottom">Modification de l'employé : {{ $employe->lastname }}</h1>
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

            <form action="{{ route('employes.update', $employe->id) }}" class="form border p-3 my-5" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="lastname">Nom</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname', $employe->lastname) }}">
                </div>
                <div class="mb-3">
                    <label for="firstname">Prénom</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname', $employe->firstname) }}">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $employe->email) }}">
                </div>
                <div class="mb-3">
                    <label for="hiring_date">Date d'embauche</label>
                    <input type="date" name="hiring_date" id="hiring_date" class="form-control" value="{{ old('hiring_date', $employe->hiring_date->format('Y-m-d')) }}">
                </div>
                <div class="mb-3">
                    <label for="salary">Salaire</label>
                    <input type="text" name="salary" id="salary" class="form-control" value="{{ old('salary', $employe->salary) }}">
                </div>
                <div class="mb-3">
                    <label for="service_id">Service</label>
                    <select name="service_id" id="service_id" class="form-control">
                        @foreach($services AS $service)
                        <option value="{{ $service->id }}" 
                        
                        @if(old('service_id', $employe->service_id) == $service->id)
                            {{ ' selected ' }}
                        @endif
                            
                         >{{ $service->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photo">Photo actuelle</label><hr>
                    <img src="{{ $employe->photo_url }}" class="img-thumbnail w-50" >
                </div>
                <div class="mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <button type="submit" class="btn btn-outline-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection