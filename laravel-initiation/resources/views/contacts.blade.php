@extends('layouts.app') {{-- appel du cadre de la page resources/views/layouts/app.blade.php --}}

@section('title', 'Contacts') {{-- définition du titre de cette page --}}

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
                        <th>date</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @if($contacts->isEmpty())
                        <tr>
                            <td colspan="4">Aucun contact pour le moment.</td>
                        </tr>
                    @else 
                        @foreach($contacts AS $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->created_at->format('d/m/Y à H:i') }}</td>
                                <td>{{ $contact->message }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>   

@endsection