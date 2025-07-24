@extends('layouts.app')

@section('title', 'Show')

@section('content')
<h1 class="pb-3 border-bottom">Détails</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $employe->photo_url }}" class="img-thumbnail w-100">
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><b>Nom : </b>{{ $employe->lastname }}</li>
                    <li class="list-group-item"><b>Prénom : </b>{{ $employe->firstname }}</li>
                    <li class="list-group-item"><b>Email : </b><a href="mailto:{{ $employe->email }}">{{ $employe->email }}</a></li>
                    <li class="list-group-item"><b>Service : </b>{{ $employe->service->service_name }}</li>
                    <li class="list-group-item"><b>Salaire : </b>{{ $employe->salary }} €</li>
                    <li class="list-group-item"><b>Date d'embauche : </b>{{ $employe->hiring_date->format('d/m/Y') }}</li>

                </ul>
            </div>
        </div>
@endsection