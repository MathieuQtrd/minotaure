<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl ">
            {{ __('Tableau de bord : Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <p class="bg-green-100 text-green-700 p-4 rounded-lg shadow-md mb-4">{{ session('success') }}</p>
                    @endif

                    @if(session('error'))
                        <p class="bg-red-100 text-red-700 p-4 rounded-lg shadow-md mb-4">{{ session('error') }}</p>
                    @endif

                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Rôle : {{ $role->name }}</h1>
                    
                    {{-- Pour obtenir le premier role d'un utilisateur : $user->roles->first()->name --}}
                    {{-- 
                        @dump($users)
                        @dump($roles)

                        Exercice :
                        - Affichez la liste des utilisateurs dans un tableau html : id, name, email
                        - Affichez également son rôle

                        - Pour aller plus loin : 
                            - affichez une liste déroulante contenant tous les roles, le role de l'utilisateur doit être en selected dans cette liste
                            - ce select option doit etre dans un formulaire, juste le select pas besoin de submit

                        - Pour aller plus loin faire un autre form avec un bouton submit uniquement "Supprimer" (qui nous servira ensuite à supprimer l'utilisateur)

                        - la liste des roles et le bouton supprimer doivent être sur toutes les lignes du tableau sauf sur la ligne de l'utilisateur en cours
                    
                    --}}

                    <div class="mb-5">
                        <a href="{{ route('admin.roles.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Retour</a>
                    </div>

                    <div class="mb-5">
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <p class="py-3">Permissions disponibles</p>
                            @foreach($permissions AS $permission)
                            <div class="py-1">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                @if($role->hasPermissionTo($permission->name)) checked @endif
                                > <label for="">{{ $permission->name }}</label><br>
                            </div>
                            @endforeach

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-5 rounded">Mettre à jour</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
