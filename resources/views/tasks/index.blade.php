@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Popis svih zadataka</h2>
    <table class="table table-striped table-bordered table-hover mt-4">
        
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-2">
            <div class="row">
                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Svi statusi</option>
                        <option value="1" {{ request('status') == 'blank' ? 'selected' : '' }}>Nije preuzeto</option>
                        <option value="2" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Preuzeto</option>
                        <option value="3" {{ request('status') == 'pending' ? 'selected' : '' }}>U tijeku</option>
                        <option value="4" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Otkazano</option>
                        <option value="5" {{ request('status') == 'done' ? 'selected' : '' }}>Rješeno</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Primijeni</button>
                </div>
            </div>
        </form>
        <div class="col-md-6">
            <span class="align-text-bottom">Ukupno zadataka: <strong>{{ $totalTasks }}</strong></span>
        </div>
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="{{ route('tasks.index', ['sort_by' => 'task_code', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Task Code
                        @if (request('sort_by') == 'task_code')
                            <i class="bi {{ request('sort_order') == 'asc' ? 'bi-sort-up' : 'bi-sort-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('tasks.index', ['sort_by' => 'task_name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Task Name
                        @if (request('sort_by') == 'task_name')
                            <i class="bi {{ request('sort_order') == 'asc' ? 'bi-sort-up' : 'bi-sort-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('tasks.index', ['sort_by' => 'company_name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Kompanija
                        @if (request('sort_by') == 'company_name')
                            <i class="bi {{ request('sort_order') == 'asc' ? 'bi-sort-up' : 'bi-sort-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('tasks.index', ['sort_by' => 'activity_name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Vrsta aktivnosti
                        @if (request('sort_by') == 'activity_name')
                            <i class="bi {{ request('sort_order') == 'asc' ? 'bi-sort-up' : 'bi-sort-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Status</th>
                <th>Zaduženi korisnici</th>
                @if (Auth::user()->role_id != 2) 
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
            <tr>
                <td>{{ $task->task_code }}</td>
                <td>{{ $task->task_name }}</td>
                <td>{{ $task->companyProfile->company_name ?? 'N/A' }}</td>
                <td>{{ $task->activityType->name ?? 'N/A' }}</td>
                <td>{{ $task->taskStatus->name ?? 'N/A' }}</td>
                <td>
                    @foreach($task->users as $user)
                        {{ $user->first_name }} {{ $user->last_name }} <br>
                    @endforeach
                </td>
                @if (Auth::user()->role_id != 2) 
                <td>
                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#assignUsersModal{{ $task->id }}">
                        <i class="bi bi-people"></i> Dodijeli korisnike
                    </button>
                </td>
                @endif
            </tr>
        
            <!-- Modal za trenutni zadatak -->
            <div class="modal fade" id="assignUsersModal{{ $task->id }}" tabindex="-1" aria-labelledby="assignUsersModalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="assignUsersModalLabel{{ $task->id }}">Dodijeli korisnike zadatku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                        </div>
                        <form action="{{ route('tasks.assignUsers', $task->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p>Označite korisnike koje želite dodati ili ukloniti iz zadatka:</p>
                                <div class="form-check">
                                    @foreach($users as $user)
                                        <div class="mb-2">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="user-{{ $task->id }}-{{ $user->id }}" 
                                                   name="users[]" 
                                                   value="{{ $user->id }}" 
                                                   {{ $task->users->contains($user->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="user-{{ $task->id }}-{{ $user->id }}">
                                                {{ $user->first_name }} {{ $user->last_name }} ({{ $user->name }})
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                                <button type="submit" class="btn btn-primary">Spremi promjene</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="7" class="text-center">Nema dostupnih zadataka.</td>
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