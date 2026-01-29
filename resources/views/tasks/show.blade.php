@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-gradient fw-bold mb-0">View Task</h2>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary-glow">
                <i class="bi bi-arrow-left me-2"></i> Back
            </a>
        </div>

        <div class="glass-panel p-5">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <span class="text-white-50 small text-uppercase fw-bold ls-1">Task Details</span>
                    <h3 class="mt-2 text-white">{{ $task->title }}</h3>
                </div>
                @php
                    $badgeClass = match($task->status) {
                        'completed' => 'badge-completed',
                        'in progress' => 'badge-inprogress',
                        default => 'badge-pending',
                    };
                @endphp
                <span class="badge badge-custom {{ $badgeClass }} fs-6">
                    {{ ucfirst($task->status) }}
                </span>
            </div>

            <div class="mb-4">
                <label class="text-white-50 small text-uppercase fw-bold ls-1 mb-2">Description</label>
                <div class="p-4 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid var(--glass-border);">
                    <p class="mb-0 text-light">{{ $task->description ?? 'No description provided.' }}</p>
                </div>
            </div>

            <div class="row text-white-50 small">
                <div class="col-md-6">
                    <p class="mb-1"><i class="bi bi-calendar3 me-2"></i> Created: <span class="text-white">{{ $task->created_at->format('d M, Y h:i A') }}</span></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-1"><i class="bi bi-clock-history me-2"></i> Last Updated: <span class="text-white">{{ $task->updated_at->format('d M, Y h:i A') }}</span></p>
                </div>
            </div>

            <hr class="my-4" style="border-color: var(--glass-border);">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-glow">
                    <i class="bi bi-pencil me-2"></i> Edit Task
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
