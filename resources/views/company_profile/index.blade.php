@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Popis kompanija</h1>
    <a href="{{ route('company_profiles.create') }}" class="btn btn-primary mb-3">Dodaj novu kompaniju</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Naziv kompanije</th>
                <th>Opis</th>
                <th>Početak partnerstva</th>
                <th>Zadnje ažuriranje</th>
                <th>Kraj partnerstva</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companyProfiles as $key => $profile)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $profile->company_name }}</td>
                    <td>{{ $profile->description }}</td>
                    <td>{{ $profile->partnership_start_at }}</td>
                    <td>{{ $profile->partnership_updated_at ?? 'N/A' }}</td>
                    <td>{{ $profile->partnership_ended ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('company_profiles.edit', $profile->id) }}" class="btn btn-sm btn-warning">Uredi</a>
                        <form action="{{ route('company_profiles.destroy', $profile->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Jeste li sigurni?')">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
