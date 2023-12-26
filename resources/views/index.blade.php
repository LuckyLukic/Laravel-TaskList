<h1> List of taks</h1>


<div>
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('task.show', ['id' => $task->id]) }}"> {{ $task->title }}</a>
        </div>
    @empty
        <div>there are no tasks</div>
    @endforelse
</div>
