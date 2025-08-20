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

                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Gestion des rôles</h1>
                    {{-- Pour obtenir le premier role d'un utilisateur : $user->roles->first()->name --}}
                    {{-- 
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
                        <a href="{{ route('admin.roles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Ajouter un rôle</a>
                    </div>

                    <table class="w-full border-collapse text-left">
                        <tr class="border">
                            <th class="p-3">Id</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Permissions</th>
                            <th class="p-3">Modifier</th>
                            <th class="p-3">Supprimer</th>
                        </tr>
                        @foreach($roles AS $role)
                        <tr class="border">
                            <td class="p-3">{{ $role->id }}</td>
                            <td class="p-3">{{ $role->name }}</td>
                            <td class="p-3">
                                    @foreach($role->permissions AS $permission)
                                    {{ $permission->name }}<br>
                                    @endforeach

                            </td>
                            <td>
                                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                                    <a href="{{ route('admin.roles.show', $role->id) }}"><i class="fa-regular fa-eye"></i></a>
                                </button>
                                
                            </td>
                            <td class="p-3">
                                @if($role->name === 'admin')
                                    -
                                @else
                                
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return(confirm('Etes vous sûr ?'))"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                                
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
