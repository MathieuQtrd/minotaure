
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

                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Création évènement</h1>
                    <form method="POST" action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="my-5">
                            <x-input-label for="title" :value="__('title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" title="title" :value="old('title', $event->title)" required autofocus autocomplete="title" name="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="my-5">
                            <x-input-label for="description" :value="__('description')" />
                            <textarea id="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" title="description"  required autofocus autocomplete="description" name="description" >{{old('description', $event->description)}}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="my-5">
                            <x-input-label for="date" :value="__('date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" title="date" :value="old('date', $event->date->format('Y-m-d'))" required autofocus autocomplete="date" name="date" />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                        <div class="my-5">
                            <x-input-label for="location" :value="__('location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" title="location" :value="old('location', $event->location)" required autofocus autocomplete="location" name="location" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>
                        <div class="my-5">
                            <x-input-label for="capacity" :value="__('capacity')" />
                            <x-text-input id="capacity" class="block mt-1 w-full" type="text" title="capacity" :value="old('capacity', $event->capacity)" required autofocus autocomplete="capacity" name="capacity" />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>
                        <div class="my-5">
                            <x-input-label for="price" :value="__('price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" title="price" :value="old('price', $event->price)" required autofocus autocomplete="price" name="price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="my-5">
                            <x-input-label for="image" :value="__('Image actuelle')" />
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" width="140">
                        </div>
                        <div class="my-5">
                            <x-input-label for="image" :value="__('image')" />
                            <input id="image" class="block mt-1 w-full" type="file" title="image" autofocus autocomplete="image" name="image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Mettre à jour') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
