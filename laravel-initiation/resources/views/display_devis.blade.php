
@extends('layouts.app') {{-- appel du cadre de la page resources/views/layouts/app.blade.php --}}

@section('title', 'Affichage devis') {{-- définition du titre de cette page --}}

@section('content')
<h1 class="pb-3 border-bottom">{{ $title }}</h1>
    <div class="row">
        <div class="col-12">
            {{-- @dump($contacts) --}}
            {{-- @dd($title) fais un dump et bloque l'exécution du code suivant --}}
            <table class="table table-bordered my-5">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        <th>date</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @if($devis->isEmpty())
                        <tr>
                            <td colspan="5">Aucun devis pour le moment.</td>
                        </tr>
                    @else 
                        @foreach($devis AS $line)
                            <tr>
                                <td>{{ $line->name }}</td>
                                <td>{{ $line->email }}</td>
                                <td>{{ $line->subject }}</td>
                                <td>{{ $line->created_at->format('d/m/Y à H:i') }}</td>
                                <td>{{ $line->message }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>   
@endsection