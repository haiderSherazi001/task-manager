<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <h1>View Task</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $task->description ?? 'No description' }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p class="card-text"><small class="text-muted">Created at: {{ $task->created_at->format('d M, Y H:i') }}</small></p>
        </div>
    </div>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning mt-3">Edit Task</a>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
