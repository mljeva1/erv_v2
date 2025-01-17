@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Popis kompanija</h2>
        <a href="{{ route('company_profiles.create') }}" class="btn btn-primary">Dodaj novu kompaniju</a>
    </div>
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
                @auth
                    @if (Auth::user()->role_id == 1)
                    <th>Akcije</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($companyProfiles as $key => $profile)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $profile->company_name }}</td>
                <td>{{ $profile->description }}</td>
                <td>{{ $profile->partnership_start_at }}</td>
                <td>{{ $profile->partnership_updated_at }}</td>
                <td>{{ $profile->partnership_ended == 0 ? 'U tijeku' : 'Završeno' }}</td>
                @auth
                    @if (Auth::user()->role_id == 1)
                    <td>
                        <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCompanyModal{{ $profile->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <form action="{{ route('company_profiles.destroy', $profile->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Jeste li sigurni?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                @endauth
            </tr>

            <!-- Modal za uređivanje kompanije -->
            <div class="modal fade" id="editCompanyModal{{ $profile->id }}" tabindex="-1" aria-labelledby="editCompanyModalLabel{{ $profile->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCompanyModalLabel{{ $profile->id }}">Uredi kompaniju</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                        </div>
                        <form action="{{ route('company_profiles.update', $profile->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="company_name{{ $profile->id }}" class="form-label">Naziv kompanije</label>
                                    <input type="text" class="form-control" id="company_name{{ $profile->id }}" name="company_name" value="{{ $profile->company_name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description{{ $profile->id }}" class="form-label">Opis</label>
                                    <textarea class="form-control" id="description{{ $profile->id }}" name="description">{{ $profile->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="partnership_start_at{{ $profile->id }}" class="form-label">Početak partnerstva</label>
                                    <input 
                                        type="date" 
                                        class="form-control" 
                                        id="partnership_start_at{{ $profile->id }}" 
                                        name="partnership_start_at" 
                                        value="{{ \Carbon\Carbon::parse($profile->partnership_start_at)->format('Y-m-d') }}"
                                        required>
                                </div>                                
                                <div class="mb-3">
                                    <label for="partnership_ended{{ $profile->id }}" class="form-label">Status partnerstva</label>
                                    <select class="form-select" id="partnership_ended{{ $profile->id }}" name="partnership_ended">
                                        <option value="0" {{ $profile->partnership_ended == 0 ? 'selected' : '' }}>U tijeku</option>
                                        <option value="1" {{ $profile->partnership_ended == 1 ? 'selected' : '' }}>Završeno</option>
                                    </select>
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
            @endforeach
            @if ($companyProfiles->isEmpty())
            <tr>
                <td colspan="7" class="text-center">Nema dostupnih kompanija.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection