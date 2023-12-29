@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')


    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}" class="font-medium text-gray-700 underline decoration-pink-500">Add Task</a>
    </nav>
    @forelse ($tasks as $task)
        <div>
            {{-- @class allaws to have an Array of classed always displayed and we can add conditions adding a value to the class. the value would be the condition --}}
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])> {{ $task->title }}</a>
        </div>
    @empty
        <div>there are no tasks</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">{{ $tasks->links() }}</nav>
    @endif

@endsection
