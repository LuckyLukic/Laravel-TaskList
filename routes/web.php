<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
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
    return view('index', ['tasks' => Task::latest()->paginate()]); // latest() returns an instance of the query builder, with an SQL ORDER BY clause applied.
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create'); //renderizzo solo la pagina, non applico nessun metodo CRUD

Route::get('/tasks/{task}/edit', function (Task $task) { //route model binding

    //refactoring
    return view('edit', ['task' => $task]);

    // return view('edit', ['task' => Task::findOrFail($id)]); //if does not find anything return a 404 page

})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {

    //refactoring
    return view('show', ['task' => $task]);

    //return view('show', ['task' => Task::findOrFail($id)]); //if does not find anything return a 404 page

})->name('tasks.show');

route::post('/tasks', function (Request $request) { // Request give us access to all the data sent. Since we created a Form validation class (TaskRequest), would have been more correct using that for code consistency.
    $data = $request->validate([  //validate is specific method of object Request which perform the validation and returns validated data.
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    //refactoring after implemented Task model with fillable attributes for mass assignation
    $task = Task::create($data); //mass assignment

    return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Task created successfully'); //this flash message will be available only for that specific session

})->name('tasks.store');

route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {  //TaskRequest accesses to personalized validation that we can share across the app

    $data = $request->validated(); //using validated() because we go through the Form validation class (TaskRequest) and return the data validated.

    //refactoring
    // $task = Task::findOrFail($id);
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    //refactoring after implementing Task with fillable attributes for mass assignation
    $task->update($data);

    return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Task updated successfully');

})->name('tasks.update');



Route::delete('/tasks/{task}', function (Task $task) {

    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task has been removed');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated!');
})->name('tasks.toggle-complete');




Route::fallback(function () {
    return "page does not exist";
});
