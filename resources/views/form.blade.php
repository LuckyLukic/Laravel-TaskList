@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@Section('content')
    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task]) : route('tasks.store') }}" method="POST">
        @csrf {{-- to protect the form from external third party through the token generated --}}
        @isset($task)
            @method('PUT')
        @endisset

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}">
            {{-- value="{{ old('title') }}": to keep old value in case of bad request , ?? means if it's not null keep the old text else doesn't give error. --}}
        </div>
        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" rows=5>{{ $task->description ?? old('description') }}</textarea>
        </div>
        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="long_description">Long description</label>
            <textarea type="text" name="long_description" id="long_description" rows=10> {{ $task->long_description ?? old('long_description') }}</textarea>
        </div>
        @error('long_description')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">
            @isset($task)
                Update Task
            @else
                Add Task
            @endisset
        </button>
    </form>
@endsection
