<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
</head>
<body>
    <h1>Create a Task</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Title:</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
            >
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea
                id="description"
                name="description"
            >{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="priority">Priority:</label>
            <select id="priority" name="priority">
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <button type="submit">Create Task</button>
    </form>

    <p><a href="{{ route('tasks.index') }}">Back to Tasks</a></p>
</body>
</html>