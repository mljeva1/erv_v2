@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center flex-column mt-4 container mt- text-center" style="max-width: 40%;">
    <h2>Rezultati pretrage za: "{{ $query }}"</h2>

    @if($users->isEmpty() && $tasks->isEmpty() && $companies->isEmpty())
        <h4>Nema rezultata za vaš upit.</h4>
    @else
        <!-- Rezultati korisnika -->
        @if (Auth::user()->role_id != 2)
            @if(!$users->isEmpty())
                <ul class="list-group mb-4">
                    @foreach($users as $user)
                        <li class="list-group-item">
                            Korisnici > {{ $user->first_name }} {{ $user->last_name }} ({{ $user->name }}) 
                            <a href="{{ route('users.index', $user->id) }}">
                                <i class="ps-1 bi bi-arrow-up-right-square-fill"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endif

        <!-- Rezultati zadataka -->
        @if(!$tasks->isEmpty())
            <ul class="list-group mb-4">
                @foreach($tasks as $task)
                    <li class="list-group-item">
                        Taskovi > {{ $task->task_name }} ({{ $task->task_code }})
                        <a href="{{ route('tasks.index', $task->id) }}">
                            <i class="ps-1 bi bi-arrow-up-right-square-fill"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Rezultati kompanija -->
        @if (Auth::user()->role_id != 2)
            @if(!$companies->isEmpty())
                <h4>Kompanije</h4>
                <ul class="list-group">
                    @foreach($companies as $company)
                        <li class="list-group-item">
                            Profili tvrtki > {{ $company->company_name }}
                            <a href="{{ route('company_profiles.index', $company->id) }}">
                                <i class="ps-1 bi bi-arrow-up-right-square-fill"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endif
    @endif
</div>
@endsection