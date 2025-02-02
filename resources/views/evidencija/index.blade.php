@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Moja Evidencija Radnog Vremena</h2>
    <a href="{{ route('evidencija.create') }}" class="btn btn-primary">Dodaj evidenciju</a>
    <table class="table">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Task</th>
                <th>Aktivnost</th>
                <th>Sati</th>
                <th>Opis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evidencije as $evidencija)
            <tr>
                <td>{{ $evidencija->datum }}</td>
                <td>{{ $evidencija->task->name ?? '-' }}</td>
                <td>{{ $evidencija->activityType->name ?? '-' }}</td>
                <td>{{ $evidencija->sati }}</td>
                <td>{{ $evidencija->opis }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
