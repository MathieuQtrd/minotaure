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
                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Gestion utilisateur</h1>
                    
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
                    <table class="w-full border-collapse text-left">
                        <tr class="border">
                            <th class="p-3">Id</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Modifier</th>
                            <th class="p-3">Supprimer</th>
                        </tr>
                        @foreach($users AS $user)
                        <tr class="border">
                            <td class="p-3">{{ $user->id }}</td>
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->roles->first()->name }}</td>
                            <td class="p-3">
                                @if(auth()->id() === $user->id)
                                {{ $user->roles->first()->name }}
                                @else
                                <form action="">
                                    <select name="" id="">
                                        @foreach($roles AS $role)
                                        <option value="">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                @endif
                            </td>
                            <td class="p-3">

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
