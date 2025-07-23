<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- commentaire dans un fichier blade --}}
        {{-- titre provenant de la vue concernée --}}
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="/">Initiation</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/galerie">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list_contact') }}">Affichage des Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('devis.create') }}">Demande de devis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('devis.list') }}">Affichage des devis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mentions') }}">Mentions</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <main class="container my-5">
            {{-- contenu --}}
            @yield('content')
        </main>

        <footer class="bg-dark text-white p-5">
            <div class="container">
                <p> Copyright &copy; 2025 </p>                
            </div>
        </footer>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>