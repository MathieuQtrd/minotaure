<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories',
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(), // on récupère les erreurs de validation
                'message' => 'Erreur',
            ], 422); // 422 : Code HTTP : Erreur de validation
        }

        // On crée la catégorie
        Category::create([
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'Nouvelle categorie créée']);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Categorie supprimée']);
    }
}
