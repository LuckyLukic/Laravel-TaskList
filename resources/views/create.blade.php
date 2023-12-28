@extends('layouts.app')

@section('title', 'Create Task')

@Section('content')
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf {{-- to protect the form from external third party through the token generated --}}

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>
        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" rows=5></textarea>
        </div>
        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <div>
            <label for="long_description">Long description</label>
            <textarea type="text" name="long_description" id="long_description" rows=10></textarea>
        </div>
        @error('long_description')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">Add Task</button>
    </form>
@endsection
