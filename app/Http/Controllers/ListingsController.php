<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    // Obtener y mostrar todos los listings
    public function index()
    {
        // carpeta.view
        return view('listings.index', [
            // Usamos la función para ordenarlo de más reciente a menos y obtenerlo después
            'listings' => Listings::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Mostrar un listing individual
    public function show(Listings $listings)
    {
        // carpeta.view
        return view('listings.show', [
            'listings' => $listings
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('listings.create');
    }

    // Almacenar el listing creado
    public function store(Request $request)
    {
        // Validamos el formulario de registro, en caso de fallar, mandará errores a la pantalla de create con el atributo @error
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // Revisamos que tengamos un archivo subido para guardarlo en public/logos
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        // Creamos el Listing
        Listings::create($formFields);

        // Redirigimos y agregamos un mensaje Flash
        return redirect('/')->with('message', 'Listing creado exitosamente');
    }

    // Mostrar el formulario de edición
    public function edit(Listings $listings)
    {
        return view('listings.edit', [
            'listings' => $listings
        ]);
    }

    // Actualizar el listing
    public function update(Request $request, Listings $listings)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Actualizamos el Listing
        $listings->update($formFields);

        // Redirigimos y agregamos un mensaje Flash
        return back()->with('message', 'Listing actualizado exitosamente');
    }

    // Eliminar el listing
    public function destroy(Listings $listings)
    {
        $listings->delete();
        return redirect('/')->with('message', 'Listing eliminado exitosamente');
    }
}
