@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-gradient fw-bold mb-0">Edit Task</h2>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary-glow">
                <i class="bi bi-arrow-left me-2"></i> Back
            </a>
        </div>

        <div class="glass-panel p-5">
            @if ($errors->any())
                <div class="alert alert-danger mb-4" style="background: rgba(220, 53, 69, 0.2); border-color: rgba(220, 53, 69, 0.3); color: #ffadad;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label">Task Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}" placeholder="Enter task title...">
                </div>

                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter task details...">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ old('status', $task->status)=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in progress" {{ old('status', $task->status)=='in progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $task->status)=='completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-glow">
                        <i class="bi bi-check-circle me-2"></i> Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
