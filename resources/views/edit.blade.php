@extends('layouts.app')

{{-- @section('title', 'Edit Task') --}}

@Section('content')
    @include('form', ['task' => $task])
    {{-- <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
        @csrf {{-- to protect the form from external third party through the token generated --}}
    {{-- @method('PUT') {{-- method spoofing: Laravel knows that has to redirect to a route that has PUT method in this case --}}
    {{-- <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title }}">
        </div>
        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" rows=5>{{ $task->description }}</textarea>
        </div>
        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="long_description">Long description</label>
            <textarea type="text" name="long_description" id="long_description" rows=10>{{ $task->long_description }}</textarea>
        </div>
        @error('long_description')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">Edit Task</button>
    </form> --}}
@endsection
