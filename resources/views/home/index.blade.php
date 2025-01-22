@extends('layouts.app')

@section('title', 'Početna - Evidencija radnog vremena')

@section('content')
<div class="text-center align-middle pt-5">
    @guest
        <h2>Dobrodošli u sustav Evidencije radnog vremena!</h2>
        <p>Ovdje možete pratiti radno vrijeme zaposlenika, zadatke i generirati izvještaje.</p>
        <p>Prijavite se kako bi vidjeli sučelje</p>
    @else
        <h2>Dobrodošao {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2><br><br><br>
    @endguest
    @auth
        @if (Auth::user()->role_id == 1) 
            <span class="align-text-bottom">Ukupno zadataka: <strong>{{ $totalTasks }}</strong></span><br>
            <span class="align-text-bottom">Ukupno korisnika: <strong>{{ $totalUsers }}</strong></span>
        @else
        <h3 class="mt-4">Zadaci na kojima ste zaduženi:</h3>
        @if ($assignedTasks->isEmpty())
            <p class="text-muted">Trenutno niste zaduženi ni za jedan zadatak.</p>
        @else
            <ul class="list-group mt-3" style="max-width: 60%; margin: 0 auto;">
                @foreach ($assignedTasks as $task)
                    <li class="list-group-item">
                        {{ $task->task_name }} ({{ $task->task_code }})
                    </li>
                @endforeach
            </ul>
            @endif
        @endif
    @endauth
</div>
@endsection