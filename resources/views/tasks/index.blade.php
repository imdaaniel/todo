@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">
    <a href="{{ route('tasks.create') }}" class="btn btn-success">Add New Task</a>

    @if (session('message'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    @if ($errors->any()))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium"{{ $errors->first() }}</span>
        </div>
    @endif

    @if ($tasks->isEmpty())
        <p>No tasks available.</p>
    @else
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="text-center">Completed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ (string) $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td class="text-center">
                            <form action="{{ route('tasks.changeStatus', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="checkbox" name="is_completed" value="1" onchange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }} />
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection