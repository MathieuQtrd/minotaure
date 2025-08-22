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
                    <a href="{{ route('admin.projects.index') }}" class="bg-violet-500 text-white px-4 py-2 rounded mb-4 inline-block">
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





                    <form action="{{ route('admin.project.user.add', $project->id) }}" method="POST">
                        @csrf 
                        <div class="mb-4">
                            <p class="text-xl mb-2">Employés disponibles</p>
                            <select name="user_id" id="user_id" value="" required class="w-full border px-3 py-2">
                                @foreach($availableUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->roles->first()->name }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded">Ajouter un employé</button>
                    </form>
                    <table class="w-full border-collapse text-left">
                        <tr class="border-b">
                            <th class="p-3">Employés</th>
                            <th class="p-3">Supprimer</th>
                        </tr>
                        {{-- @dump($project) --}}
                        @foreach($project->users AS $user)
                            <tr class="border-b">
                                <td class="p-3">{{ $user->name }} - {{ $user->roles->first()->name }}</td>
                                <td class="p-3">
                                    <form action="{{ route('admin.project.user.remove', [$project->id, $user->id]) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" onclick="return(confirm('Etes vous sur ?'))" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
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
