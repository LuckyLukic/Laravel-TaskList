@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@Section('content')
    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task]) : route('tasks.store') }}" method="POST">
        @csrf {{-- to protect the form from external third party through the token generated --}}
        @isset($task)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" @class(['border-red-500' => $errors->has('title')])
                value="{{ $task->title ?? old('title') }}">
            {{-- value="{{ old('title') }}": to keep old value in case of bad request , ?? means if it's not null keep the old text else doesn't give error. --}}

            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" rows=5 @class(['border-red-500' => $errors->has('description')])>{{ $task->description ?? old('description') }}

        </textarea>

            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">Long description</label>
            <textarea type="text" name="long_description" id="long_description" rows=10 @class(['border-red-500' => $errors->has('long_description')])> {{ $task->long_description ?? old('long_description') }}

        </textarea>

            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-2 items-center">
            <button type="submit" class="btn">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
            <a href="{{ route('tasks.index') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection
