<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title:</label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $task->title) }}"
            >
        </div>

        <div>
            <label>Description:</label>
            <textarea name="description">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label>Status:</label>
            <select name="status">
                <option value="pending" @selected(old('status', $task->status) === 'pending')>Pending</option>
                <option value="completed" @selected(old('status', $task->status) === 'completed')>Completed</option>
            </select>
        </div>

        <div>
            <label>Priority:</label>
            <select name="priority">
                @foreach (['low', 'medium', 'high'] as $priority)
                    <option
                        value="{{ $priority }}"
                        @selected(old('priority', $task->priority) === $priority)
                    >
                        {{ ucfirst($priority) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update Task</button>
    </form>

    <p><a href="{{ route('tasks.index') }}">Back to Tasks</a></p>
</body>
</html>