<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', ['tasks' => Task::latest()->get()]); // latest() returns an instance of the query builder, with an SQL ORDER BY clause applied.
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create'); //renderizzo solo la pagina, non applico nessun metodo CRUD

Route::get('/tasks/{id}', function ($id) {

    return view('show', ['task' => Task::findOrFail($id)]); //if does not find nythinf return a 404 page

})->name('tasks.show');

route::post('/tasks', function (Request $request) { // Request give us access to all the data sent
    dd($request->all());
})->name('tasks.store');




Route::fallback(function () {
    return "page does not exist";
});
