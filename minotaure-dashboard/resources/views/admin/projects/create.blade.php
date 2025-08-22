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
                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                            @foreach($errors->all() AS $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('admin.projects.store') }}" method="POST">
                        @csrf 
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Titre</label>
                            <input type="text" name="name" id="name" value="" required class="w-full border px-3 py-2">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea name="description" id="description" required class="w-full border px-3 py-2"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="client_id" class="block text-gray-700">Client</label>
                            <select name="client_id" id="client_id" value="" required class="w-full border px-3 py-2">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-gray-700">Employés</label>
                            <div class="mb-4">
                                @foreach($users as $user)
                                    <input type="checkbox" name="users[]" id="name" value="{{ $user->id }}" class="border">
                                    <label>{{ $user->name }} - {{ $user->roles->first()->name }}</label><br>
                                @endforeach
                            </div>   
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
