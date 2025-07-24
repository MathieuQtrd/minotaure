<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // on récupère les employes avec leur service
        $employes = Employe::with('service')->get();
        // pour l'affichage : $employe->service->service_name
        return view('employes.index', ['employes' => $employes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all(); // pour le select option
        return view('employes.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employes,email',
            'hiring_date'   => 'required|date',
            'salary'        => 'required|numeric|min:0',
            'service_id'    => 'required|exists:services,id',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;

            // L'image sera enregistrée dans le dossier storage/public/photos
            // Elle ne sera pas disponible naturellement pour le front.
            // Pour la rendre disponible en front il faut exécuté au moins une fois la ligne de commande suivante :
            // php artisan storage:link
        }

        Employe::create($validated);

        return back()->with('success', 'Nouvel employé enregistré');

    }

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employe $employe)
    {
        // le mail de l'employé existe
        // en rajoutant l'id de l'employé, cela permet de ne pas tester cette ligne sur l'unicité
        // 'email' => 'required|email|max:255|unique:employes,email,' . $employe->id,
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employe $employe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe)
    {
        // Storage::disk('public')->delete($employe->photo);
    }
}


/*
    L'outil Storage de laravel permet de gérer les fichiers (local, public, cloud) :
    --------------------------------------------------------------------------------
    // https://laravel.com/docs/12.x/filesystem

    - config/filesystems.php

    public place les fichiers dans storage/app/public :
    il nous faudra exécuter sur la console :
    php artisan storage:link
    afin de les rendre disponibles des public/storage 

    cela crée un lien symbolique entre les deux dossiers

    // stocker un fichier photo dans le disque public :
    $path = $request->file('photo')->store('photos', 'public');
    // $path représente le chemin relatif que l'on stockera en bdd : exemple : photos/fichier.jpg

    // Pour supprimer un fichier
    Storage::disk('public')->delete($employe->photo);

    // Pour afficher le fichier dans une vue
    <img src="{{ Storage::url($employe->photo) }}">

    // Voir le model Employe :
    // En passant par l'accessor, nous appliquons le Storage::url() en amont et cela nous permet d'avoir le bon chemin directement dans un  nouvel attribut créé via l'accessor : $employe->photo_url
    <img src="{{ $employe->photo_url }}">

*/