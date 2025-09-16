
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

                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Affichage des évènements</h1>
                    {{-- @dump($events) --}}
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr>
                                <th class="p-3">Titre</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Location</th>
                                <th class="p-3">Capacité</th>
                                <th class="p-3">Prix</th>
                                <th class="p-3">Image</th>
                                <th class="p-3">Modifier</th>
                                <th class="p-3">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr class="border-b">
                                    <td class="p-3">{{ $event->title }}</td>
                                    <td class="p-3">{{ $event->date->format('d-m-Y') }}</td>
                                    <td class="p-3">{{ $event->location }}</td>
                                    <td class="p-3">{{ $event->capacity }}</td>
                                    <td class="p-3">{{ $event->price }}</td>
                                    <td class="p-3"><img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" width="140"></td>
                                    <td class="p-3">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-orange-500 text-white px-3 py-1 rounded inline-block">Modifier</a>
                                    </td>
                                    <td class="p-3">
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded inline-block">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
