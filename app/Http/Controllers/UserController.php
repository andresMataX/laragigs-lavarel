<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Mostrar el fomulario de Usuario
    public function create()
    {
        return view('users.register');
    }

    // Guardamos el usuario nuevo
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', Rule::unique('users', 'email'), 'email'],
            'password' => 'required|confirmed|min:6'
        ]);

        // Password con Hash
        $formFields['password'] = bcrypt($formFields['password']);

        // Creamos el nuevo usuario
        $user = User::create($formFields);

        // Logeamos
        auth()->login($user);

        return redirect('/')->with('messsage', 'Usuario y logeado');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        // Remover la información del usuario de la sesión
        auth()->logout();

        // Invalidamos el token del usuario
        $request->session()->invalidate();

        // Regeneramos el token
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Has cerrado sesión');
    }

    // Mostrar el formulario de inicio de sesión
    public function login()
    {
        return view('users.login');
    }

    // Hacer autenticación del usuario
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            // Generar el id de sesión
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Has iniciado sesión');
        }

        // NO le decimos al usuario qué falló.
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
