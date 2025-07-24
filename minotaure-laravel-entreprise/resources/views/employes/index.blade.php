@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <h1 class="pb-3 border-bottom">Liste des employés</h1>
        <div class="row">
            <div class="col-md-12">

                @if(session('success'))
                <div class="alert alert-success my-3">{!! session('success') !!}</div>
                @endif

                <table class="table table-bordered my-5">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Date d'embauche</th>
                            <th>Salaire</th>
                            <th>Détails</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employes AS $employe)
                        <tr>
                            <td>{{ $employe->id }}</td>
                            <td><img src="{{ $employe->photo_url }}" class="img-thumbnail" width="70"></td>
                            <td>{{ $employe->lastname }}</td>
                            <td>{{ $employe->firstname }}</td>
                            <td>{{ $employe->email }}</td>
                            <td>{{ $employe->service->service_name }}</td>
                            <td>{{ $employe->hiring_date->format('d/m/Y') }}</td>
                            <td>{{ $employe->salary }} €</td>
                            <td>
                                <a href="{{ route('employes.show', $employe->id) }}"><i class="bi bi-eye btn btn-primary"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('employes.edit', $employe->id) }}"><i class="bi bi-pencil-square btn btn-warning"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('employes.destroy', $employe->id) }}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class=" btn btn-danger" onclick="return(confirm('Etes-vous sûr ?'))"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

{{-- 
- Faire la page index : un tableau qui liste les employés + un bouton modifier et un bouton supprimer
- Faire la modification d'un employé (ne pas oublier de gérer l"image si elle est remplacée)
- Faire la suppression 
- Pour aller plus loin : faire la page Show (un peu comme une page de profil) qui n'affiche qu'un seul employé à la fois. Pour cela rajouter un bouton sur le tableau dans index
--}}