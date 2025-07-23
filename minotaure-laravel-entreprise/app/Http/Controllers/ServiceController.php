<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all(); // on récupère tous les services pour les afficher dans la vue
        return view('services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255|unique:services,service_name',
        ]);

        Service::create($validated);

        return back()->with('success', 'Nouveau service enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255|unique:services,service_name',
        ]);

        $old_name = $service->service_name;

        $service->update($validated);

        $new_name = $validated['service_name'];

        // on peut le faire nous même sur le ou les champs concernés
        // $service->service_name = $validated['service_name'];
        // $service->save();

        // fill() rempli tous les attributs de l'objet
        // $service->fill($validated);
        // $service->save();

        return redirect()->route('services.index')->with('success', 'Le service : <b>' . $old_name . '</b> a été renommé : <b>' . $new_name . '</b>');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $name = $service->service_name;
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Le service : <b>' . $name . '</b> a bien été supprimé');
    }
}
