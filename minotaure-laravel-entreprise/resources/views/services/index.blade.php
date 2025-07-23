@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <h1 class="pb-3 border-bottom">Liste des services</h1>
        <div class="row">
            <div class="col-md-12">

                @if(session('success'))
                <div class="alert alert-success my-3">{!! session('success') !!}</div>
                @endif

                <table class="table table-bordered my-5">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services AS $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->service_name }}</td>
                            <td>
                                <a href="{{ route('services.edit', $service->id) }}"><i class="bi bi-pencil-square btn btn-warning"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('services.destroy', $service->id) }}" method="post">
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