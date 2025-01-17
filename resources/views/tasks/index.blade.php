@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center">Popis svih taskova</h2>

    <!-- Formular za pretragu -->
    <form action="{{ route('tasks.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Pretraži taskove..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Pretraži</button>
            </div>
        </div>
    </form>

     <!-- Tablica -->
     <table class="table table-striped table-bordered table-hover mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>
                    <a href="{{ route('tasks.index', ['sort_by' => 'task_code', 'sort_order' => $sortBy === 'task_code' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Task Code
                        @if ($sortBy === 'task_code')
                            <i class="bi {{ $sortOrder === 'asc' ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('tasks.index', ['sort_by' => 'task_name', 'sort_order' => $sortBy === 'task_name' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Task Name
                        @if ($sortBy === 'task_name')
                            <i class="bi {{ $sortOrder === 'asc' ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Task Description</th>
                <th>Work Time</th>
                <th>
                    <a href="{{ route('tasks.index', ['sort_by' => 'company_profile_id', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Kompanija
                        @if (request('sort_by') == 'company_profile_id')
                            <i class="bi {{ request('sort_order') == 'asc' ? 'bi-sort-up' : 'bi-sort-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Vrsta aktivnosti</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $key => $task)
            <tr>
                <td>{{ $tasks->firstItem() + $key }}</td>
                <td>{{ $task->task_code }}</td>
                <td>{{ $task->task_name }}</td>
                <td>{{ $task->task_description }}</td>
                <td>{{ $task->work_time }}</td>
                <td>{{ $task->companyProfile->company_name ?? 'N/A' }}</td>
                <td>{{ $task->activityType->name ?? 'N/A' }}</td>
                <td>{{ $task->taskStatus->name ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Nema dostupnih taskova.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginacija -->
    @if ($tasks->hasPages())
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Prethodna stranica --}}
                @if ($tasks->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $tasks->previousPageUrl() }}" rel="prev">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif
                {{-- Brojevi stranica --}}
                @foreach ($tasks->links()->elements[0] as $page => $url)
                    @if ($page == $tasks->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
                {{-- Sljedeća stranica --}}
                @if ($tasks->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $tasks->nextPageUrl() }}" rel="next">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
@endsection