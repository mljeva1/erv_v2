@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Popis korisnika evidencije radnog vremena</h2>
    <table class="table  table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Username</th>
                <th>Email</th>
                <th>Uloga</th>
                <th>Odjel</th>
                @auth
                    @if (Auth::user()->role_id == 1)
                    <th>Akcije</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            
            @forelse($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->title ?? 'N/A' }}</td>
                <td>{{ $user->sectionRoom->naziv ?? 'N/A' }}</td>
                @auth         
                    @if (Auth::user()->role_id == 1)       
                    <td style="width: 100px;">
                        <!-- Gumb za uređivanje -->
                        <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        
                        <!-- Gumb za brisanje -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Jeste li sigurni da želite obrisati ovog korisnika?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                @endauth
            </tr>

            <!-- Modal za uređivanje korisnika -->
            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Uredi korisnika</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                        </div>
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="first_name{{ $user->id }}" class="form-label">Ime</label>
                                    <input type="text" class="form-control" id="first_name{{ $user->id }}" name="first_name" value="{{ $user->first_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="last_name{{ $user->id }}" class="form-label">Prezime</label>
                                    <input type="text" class="form-control" id="last_name{{ $user->id }}" name="last_name" value="{{ $user->last_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="name{{ $user->id }}" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="role{{ $user->id }}" class="form-label">Uloga</label>
                                    <select class="form-select" id="role{{ $user->id }}" name="role_id">
                                        <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Direktor</option>
                                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Voditelj</option>
                                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="section_room{{ $user->id }}" class="form-label">Odjel</label>
                                    <select class="form-select" id="section_room{{ $user->id }}" name="section_room_id">
                                        @foreach($sectionRooms as $sectionRoom)
                                            <option value="{{ $sectionRoom->id }}" 
                                                {{ $user->section_room_id == $sectionRoom->id ? 'selected' : '' }}>
                                                {{ $sectionRoom->naziv }}
                                            </option>
                                        @endforeach
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
            @empty
            <tr>
                <td colspan="8" class="text-center">Nema dostupnih korisnika.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
