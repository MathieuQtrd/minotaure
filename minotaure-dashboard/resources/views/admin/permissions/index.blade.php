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

                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Gestion des permissions</h1>

                    <div class="mb-5">
                        <a href="{{ route('admin.permissions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Ajouter une permission</a>
                    </div>

                    <table class="w-full border-collapse text-left">
                        <tr class="border">
                            <th class="p-3">Id</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Supprimer</th>
                        </tr>
                        @foreach($permissions AS $permission)
                        <tr class="border">
                            <td class="p-3">{{ $permission->id }}</td>
                            <td class="p-3">{{ $permission->name }}</td>
                            <td class="p-3">
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return(confirm('Etes vous sûr ?'))"><i class="fa-regular fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
