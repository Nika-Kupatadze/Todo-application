@extends('layouts.app')

@section('title', 'Tasks')


@section('content')
    <div class="container">
        <div class="d-flex justify-content-center mt-3 flex-column p-5">
            @if($msg = session('success'))
                <div class="alert alert-success" role="alert">
                    {{ $msg }}
                </div>
            @endif
            <form method="post" action="{{ route('tasks.store') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter your new task"
                           aria-label="Recipient's username" aria-describedby="basic-addon2"
                            name="task">
                    <button class="btn btn-primary" type="submit">Create new Task</button>
                </div>
            </form>
            <ul class="list-group">
                @foreach($tasks as $task)
                    @if($task->completed == false)
                        <li class="list-group-item list-group-item-success">
                            {{ $task->task }}
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary" style="float: right;">Mark as Done</a>
                        </li>
                    @else
                        <li class="list-group-item list-group-item-dark" aria-disabled="true">
                            {{ $task->task }}
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-secondary" style="float: right">Mark as Undone</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="d-flex justify-content-center">
            <div class="ms-auto">
                {{ $tasks->links() }}
            </div>
            <div class="ms-auto">
                <form method="post" action="{{ route('deleteAll') }}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="ids" value="{{ $doneTasks }}">
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete all tasks marked as done?')">
                        Delete all tasks marked as done
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
