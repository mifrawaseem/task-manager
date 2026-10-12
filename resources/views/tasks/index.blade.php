<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
</head>
<body>
    <h1>My Tasks</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('tasks.create') }}">Create New Task</a></p>
    @if ($tasks->isNotEmpty())
        <ul>
            @foreach ($tasks as $task)
            <a href="{{ route('tasks.edit', $task) }}">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this task?');">
                @csrf
                @method('DELETE')

                <button type="submit">Delete</button>
            </form>

                <li>
                    <strong>{{ $task->title }}</strong>
                    — {{ $task->status }}
                    — Priority: {{ $task->priority }}

                    @if ($task->description)
                        <p>{{ $task->description }}</p>
                    @endif
                </li>
                
            @endforeach
        </ul>
    @else
        <p>No tasks available.</p>
    @endif
</body>
</html>