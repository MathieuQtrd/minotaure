<x-front-layout title="Liste des évènement">
    <h1 class="text-4xl font-bold text-center my-6">Liste des évènements</h1>

    <div class="max-w-7xl mx-auto p-6">
        <ul id="events-list">
            <li>... chargement ...</li>
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('api/events')
            .then(response =>response.json())
            .then(data => {
                console.log(data);
                let eventList = document.getElementById('events-list');
                eventList.innerHTML = '';

                data.data.forEach(event => {
                    let localData = new Date(event.date);
                    dateFr = localData.toLocaleDateString("fr-FR");
                    
                    let li = document.createElement('li');
                    li.innerHTML = `
                    <h3 class="text-2xl font-bold text-center my-6"><a href="/events/${event.id}">${event.title}</a></h1>
                    <br>
                    <img src="/storage/${event.image}" alt="article : ${event.title}" width="100%">
                    <br>
                    <strong>Date : ${dateFr}</strong><br>
                    <strong>Location : ${event.location}</strong><br>
                    <strong>Prix : ${event.price} €</strong><br><br>
                    <hr>
                    `;                    
                    eventList.appendChild(li);
                });
            });
        });
    </script>
    
</x-front-layout>