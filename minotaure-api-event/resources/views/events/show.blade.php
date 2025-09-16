<x-front-layout title="Liste des évènement">
    <h1 class="text-4xl font-bold text-center my-6">Evènement : <span id="event-title"></span></h1>

    <div class="max-w-7xl mx-auto p-6">
        <img src="" alt="" id="event-image" class="block">
        <br>
        <p id="event-location"></p>
        <br>
        <hr>
        <br>
        <p id="event-date"></p>
        <br>
        <p id="event-description"></p>
        <br>
        <p id="event-price"></p>
        <br>
        <p id="event-capacity"></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let eventId = {{ $event }}
            fetch('/api/events/' + eventId)
            .then(response =>response.json())
            .then(data => {
                console.log(data);

                let localData = new Date(data.data.date);
                dateFr = localData.toLocaleDateString("fr-FR");

                document.getElementById('event-title').textContent = data.data.title;
                document.getElementById('event-image').src = '/storage/' + data.data.image;
                document.getElementById('event-image').alt = 'Evènement : ' + data.data.title;
                document.getElementById('event-date').innerHTML = '<strong>Date : </strong>' + dateFr;
                document.getElementById('event-location').innerHTML = '<strong>Location : </strong>' + data.data.location;
                document.getElementById('event-description').textContent = data.data.description;
                document.getElementById('event-price').innerHTML = '<strong>Prix : </strong>' + data.data.price + ' €';
                document.getElementById('event-capacity').innerHTML = '<strong>Capacité : </strong>' + data.data.capacity;

            });
        });
    </script>
    
</x-front-layout>