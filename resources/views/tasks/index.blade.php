<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class = "bg-dark">
<div class="container mt-5 border border-light">

    <h1 class="text-danger">Tasks</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search Form --}}
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-3 addForm">
        <div class="input-group">
            <input type="text" name="search" id = "searchBar" class="form-control me-2" value="{{ request('search') }}" placeholder="Search by title">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    {{-- Add Task --}}
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">Add Task</a>
    <button type = "button" id = "clearBtn" class = "btn btn-secondary mb-3">Clear</button>
    {{-- Task Table --}}
    <table class="table table-borderless table-hover table-striped table-dark">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger delBtn" data-id = {{ $task->id }}>Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No tasks found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $tasks->links() }}

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
//    const clearBtn = document.getElementById("clearBtn");
//    const searchBar = document.getElementById("searchBar");
//     clearBtn.addEventListener("click",()=>{
//         searchBar.value = "";
//     });
(()=>{
    
    $("#clearBtn").hide();

    $("#clearBtn").click(function(){
        $("#searchBar").val("");
        window.location.href = "/tasks";
    });
    $("#searchBar").on("input",function(){
        if($("#searchBar").val().trim() !== ""){
            $("#clearBtn").show();
        }
        else{
            $("#clearBtn").hide();
        }
    });

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll(".delBtn").forEach(button=>{
        button.addEventListener('click',function(){
            const taskId = this.dataset.id;
        });
    });
})();

</script>
</body>
</html>
