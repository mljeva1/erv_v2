@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center">Popis svih taskova</h2>
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Task Code</th>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>Work Time</th>
                    <th>Kompanija</th>
                    <th>Vrsta aktivnosti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                
                @forelse($tasks as $key => $task)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $task->task_code }}</td>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->task_description }}</td>
                    <td>{{ $task->work_time }}</td>
                    <td>{{ $task->company_profile_id }}</td>
                    <td>{{ $task->activity_type_id }}</td>
                    <td>{{ $task->task_status_id }}</td>
                </tr>
                
                @empty
                <tr>
                    <td colspan="8" class="text-center">Nema dostupnih taskova.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
