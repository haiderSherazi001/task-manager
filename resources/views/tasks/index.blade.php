@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="text-gradient display-5 fw-bold mb-0">Task Manager</h2>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="{{ route('tasks.create') }}" class="btn btn-glow me-2">
            <i class="bi bi-plus-lg me-1"></i> New Task
        </a>
        <button type="button" id="resetBtn" class="btn btn-secondary-glow" title="Refresh Page">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
    </div>
</div>

<div class="glass-panel p-4">
    {{-- Search Form --}}
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">
        <div class="input-group">
            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-color: var(--glass-border);">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" name="search" id="searchBar" class="form-control border-start-0 ps-0" 
                   value="{{ request('search') }}" placeholder="Search tasks by title..." 
                   style="border-color: var(--glass-border);">
            <button type="button" id="clearBtn" class="btn btn-secondary-glow ms-2" style="display: none;">
                <i class="bi bi-x-lg"></i>
            </button>
            <button type="submit" class="btn btn-primary d-none">Search</button>
        </div>
    </form>

    {{-- Task Table --}}
    <div class="table-responsive">
        <table class="table table-custom table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 5%;">Sr#</th>
                    <th style="width: 25%;">Title</th>
                    <th style="width: 40%;">Description</th>
                    <th style="width: 15%;">Status</th>
                    <th style="width: 20%;" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td class="text-secondary" id = "srNo">{{ $tasks->firstItem() + $loop->index }}</td>
                    <td class="fw-medium text-secondary border-black" id = "title">{{ $task->title }}</td>
                    <td class="text-secondary" style="max-width: 300px;" id = "description">{{ $task->description }}</td>
                    <td>
                        @php
                            $badgeClass = match($task->status) {
                                'completed' => 'badge-completed',
                                'in progress' => 'badge-inprogress',
                                default => 'badge-pending',
                            };
                        @endphp
                        <span class="badge badge-custom {{ $badgeClass }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-secondary-glow me-1" title="View">
                            <i class="bi bi-eye text-black-50"></i>
                        </a>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-secondary-glow me-1" title="Edit">
                            <i class="bi bi-pencil text-black-50"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger delBtn" data-id="{{ $task->id }}" title="Delete" style="border: 1px solid rgba(220, 53, 69, 0.5); color: #ef4444;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                        No tasks found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $tasks->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const searchInput = $("#searchBar");
        const clearBtn = $("#clearBtn");

        // Toggle clear button
        function toggleClearBtn() {
            if (searchInput.val().trim() !== "") {
                clearBtn.show();
            } else {
                clearBtn.hide();
            }
        }

        // Initial check
        toggleClearBtn();

        searchInput.on("input", toggleClearBtn);

        clearBtn.click(function() {
            searchInput.val("");
            window.location.href = "{{ route('tasks.index') }}";
        });

        $("#resetBtn").click(function() {
            window.location.reload();
        });

        // Delete functionality
        $(".delBtn").click(function() {
            const taskId = $(this).data("id");
            if (confirm('Are you sure you want to delete this task?')) {
                const row = $(this).closest('tr');
                
                $.ajax({
                    url: `/tasks/${taskId}`,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            row.fadeOut(300, function() { $(this).remove(); });
                        } else {
                            alert(response.message || 'Error deleting task');
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong!');
                        console.error(xhr);
                    }
                });
            }
        });

        $("#srNo,#title,#description").hover(function(){
            $(this).addClass("text-white");
            $(this).removeClass("text-secondary");
        }, function(){
            $(this).removeClass("text-white");
            $(this).addClass("text-secondary");
        });
    });
</script>
@endsection
