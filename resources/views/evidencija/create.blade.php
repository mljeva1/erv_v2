@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dodaj Evidenciju</h2>

    <form action="{{ route('evidencija.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="datum" class="form-label">Datum</label>
            <input type="date" name="datum" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sati" class="form-label">Sati (u četvrtinama, npr. 0.25, 0.5, 0.75, 1...)</label>
            <input type="number" step="0.25" name="sati" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="task_id" class="form-label">Task</label>
            <select name="task_id" class="form-control">
                <option value="">Bez taska</option>
                @foreach ($tasks as $task)
                    <option value="{{ $task->id }}">{{ $task->task_code }} - {{ $task->task_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="activity_type_id" class="form-label">Tip Aktivnosti</label>
            <select name="activity_type_id" class="form-control">
                <option value="">Bez aktivnosti</option>
                @foreach ($activityTypes as $activityType)
                    <option value="{{ $activityType->id }}">{{ $activityType->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="opis" class="form-label">Opis</label>
            <textarea name="opis" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Spremi</button>
    </form>
</div>
@endsection