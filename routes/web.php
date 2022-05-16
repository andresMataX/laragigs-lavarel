<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// Todos los listings

// Usamos un controlador para traer todos los listings
Route::get('/', [ListingsController::class, 'index']);

// Almacenamos información del listings
Route::post('/listings', [ListingsController::class, 'store'])->middleware('auth');

// Mostrar formulario de creación
Route::get('/listings/create', [ListingsController::class, 'create'])->middleware('auth');

// Mostrar el formulario de edición
Route::get('/listings/{listings}/edit', [ListingsController::class, 'edit'])->middleware('auth');

// Actualizar el listing
Route::put('/listings/{listings}', [ListingsController::class, 'update'])->middleware('auth');

// Eliminar el listing
Route::delete('/listings/{listings}', [ListingsController::class, 'destroy'])->middleware('auth');

// Listing individual
Route::get('/listings/{listings}', [ListingsController::class, 'show']);

// Mostrar el formulario de Usuario
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Crear un nuevo usuario
Route::post('/users', [UserController::class, 'store']);

// Cerrar sesión
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Mostrar el formulario de inicio de sesión
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest'); // Nombramos la ruta para que sea identificada por el middleware de autenticación

// Iniciar sesión del usuario
Route::post('/users/authenticate', [UserController::class, 'authenticate']);


// Todos los listings
// Route::get('/', function () {
//     return view('listings', [
//         'listings' => Listings::all()
//     ]);
// });

// Listing individual
// Pasamos un listing y este debe de coincidir con el pasado en la función, si no lo hace, saltará un error 404
// Route::get('/listings/{listings}', function (Listings $listings) {
//     return view('listing', [
//         'listings' => $listings
//     ]);
// });

// Route::get('/hola', function () {
//     return response('<h1>Hello World</h1>', 200)->header('Content-Type', 'text/plain')->header('foo', 'bar');
// });

// Route::get('/post/{id}', function ($id) {
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function (Request $request) {
//     return $request->name . ' ' . $request->city;
// });
