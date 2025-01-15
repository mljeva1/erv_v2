@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Popis korisnika</h2>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Uloga</th>
                <th>Odjel</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->title ?? 'N/A' }}</td>
                <td>{{ $user->sectionRoom->naziv ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Nema dostupnih korisnika.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection