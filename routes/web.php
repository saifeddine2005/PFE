<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/formulaire', function () {
    return view('formulaire');
});

Route::get('/formulaire', function () {
    return view('formulaire');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('index');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/create', function () {
    return view('create');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/categorie', function () {
    return view('categorie');
});
Route::get('/panier', function () {
    return view('panier');
});
Route::get('/menu', function () {
    return view('menu');
});