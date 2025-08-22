<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('developpeur.projects.index') }}" class="bg-violet-500 text-white px-4 py-2 rounded mb-4 inline-block">
                        Retour
                    </a>
                    @if(session('success'))
                        <p class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">{{ session('success') }}</p>
                    @endif
                    @if(session('error'))
                        <p class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">{{ session('error') }}</p>
                    @endif
                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                            @foreach($errors->all() AS $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <h1 class="text-2xl font-bold mb-4">Projet : {{ $project->name }}</h1>
                    <p class="p-3 border rounder mb-3">
                        Créateur du projet : {{ $project->creator->name }}
                    </p>
                    <p class="p-3 border rounder mb-3">
                        Client : {{ $project->client->name }}
                    </p>
                    <p class="p-3 border rounder mb-3">
                        {{ $project->description }}
                    </p>
                    <table class="w-full border-collapse text-left">
                        <tr class="border-b">
                            <th class="p-3">Employés</th>
                        </tr>
                        {{-- @dump($project) --}}
                        @foreach($project->users AS $user)
                            <tr class="border-b">
                                <td class="p-3">{{ $user->name }} - {{ $user->roles->first()->name }}</td>                                
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                    <!-- Formulaire pour Ajouter une Tâche -->
                    <h3 class="mt-4 font-semibold">Ajouter une Tâche</h3>
                    <form method="POST" action="{{ route('developpeur.task.store', $project->id) }}">
                        @csrf
                        <label for="name" class="block">Nom :</label>
                        <input type="text" id="name" name="name" required class="w-full p-2 border rounded">

                        <label for="description" class="block mt-2">Description :</label>
                        <textarea id="description" name="description" class="w-full p-2 border rounded"></textarea>

                        <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Ajouter</button>
                    </form>

                    <hr>
                    <!-- Liste des Tâches -->
                    <h3 class="mt-4 font-semibold">Liste des Tâches</h3>
                    <ul class="bg-white p-4 rounded shadow">
                        @if($project->tasks->isEmpty())
                        <li>Aucune tâche actuellement</li>
                        @else
                        @foreach ($project->tasks as $task)
                            <li>{{ $task->name }} | {{ $task->description }} | ({{ $task->status }}) | {{ $task->user->name }}</li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
