@extends('layouts.app')

@section('title', 'Index')

@section('content')
    {{-- @dump($employes) --}}

    @foreach($employes AS $employe)
        {{ $employe->firstname }}<br>
        {{ $employe->service->service_name }}
        <img src="{{ $employe->photo_url }}">
        {{-- <img src="{{ asset('storage/' . $employe->photo) }}"> --}}
    @endforeach
@endsection

{{-- 
- Faire la page index : un tableau qui liste les employés + un bouton modifier et un bouton supprimer
- Faire la modification d'un employé (ne pas oublier de gérer l"image si elle est remplacée)
- Faire la suppression 
- Pour aller plus loin : faire la page Show (un peu comme une page de profil) qui n'affiche qu'un seul employé à la fois. Pour cela rajouter un bouton sur le tableau dans index
--}}