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

                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Gestion des projets</h1>

                    <div class="mb-5">
                        <a href="{{ route('admin.projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Ajouter un projet</a>
                    </div>

                    <table class="w-full border-collapse text-left">
                        <tr class="border">
                            <th class="p-3">Id</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Client</th>
                            <th class="p-3">Date de création</th>
                            <th class="p-3">Détails</th>
                        </tr>
                        @foreach($projects AS $project)
                        <tr class="border">
                            <td class="p-3">{{ $project->id }}</td>
                            <td class="p-3">{{ $project->name }}</td>
                            <td class="p-3">{{ $project->status }}</td>
                            <td class="p-3">{{ $project->client->name }}</td>
                            <td class="p-3">{{ $project->created_at->format('d/m/Y') }}</td>
                            <td class="p-3">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                                    <a href="{{ route('admin.project.show', $project->id) }}"><i class="fa-regular fa-eye"></i></a>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
