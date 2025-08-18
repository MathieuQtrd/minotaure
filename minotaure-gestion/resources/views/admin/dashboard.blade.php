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
                    <h1 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Bienvenue Admin</h1>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla maiores et dolore deserunt repellat iure enim voluptatum consequuntur totam reprehenderit alias quasi unde, aperiam quaerat dolor magnam laudantium vitae cum?
                        Libero, soluta sed dolor rerum distinctio necessitatibus dolorum inventore corporis, pariatur, unde id quas! Beatae commodi explicabo nisi facilis, aut officia perspiciatis tenetur quod eius cupiditate, necessitatibus corrupti numquam voluptatem.
                        Suscipit expedita esse error in neque dolorum, minus aliquam! Quidem dolor obcaecati ratione nihil nostrum commodi cumque aut maxime numquam dolorum eius, doloremque praesentium illo facilis? Beatae fugiat fugit pariatur.
                    </p>
                    <h2 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Liste des tâches en cours : </h2>
                    <ul>
                        <li><a href="">Tâche 1</a></li>
                        <li><a href="">Tâche 2</a></li>
                        <li><a href="">Tâche 3</a></li>
                        <li><a href="">Tâche 4</a></li>
                    </ul>
                    <h2 class="font-semibold border-b-2 border-black pb-3 text-xl my-5">Liste des projets en cours : </h2>
                    <ul>
                        <li><a href="">projet 1</a></li>
                        <li><a href="">projet 2</a></li>
                        <li><a href="">projet 3</a></li>
                        <li><a href="">projet 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
