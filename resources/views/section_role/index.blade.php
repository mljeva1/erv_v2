@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sekcije -->
        <div class="col-md-6 mt-3">
            <h3>Sekcije</h3>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                Dodaj novu sekciju
            </button>

            <ul class="list-group">
                @foreach ($sections as $section)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $section->naziv }}
                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Jeste li sigurni da želite obrisati ovu sekciju?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                        </form>                        
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Role -->
        <div class="col-md-6 mt-3">
            <h3>Role</h3>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                Dodaj novu rolu
            </button>

            <ul class="list-group">
                @foreach ($roles as $role)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $role->title }}
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Modal za dodavanje nove sekcije -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSectionModalLabel">Dodaj novu sekciju</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="section_name" class="form-label">Naziv sekcije</label>
                        <input type="text" name="naziv" id="section_name" class="form-control" placeholder="Unesi naziv sekcije" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Spremi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal za dodavanje nove role -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">Dodaj novu rolu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="role_name" class="form-label">Naziv role</label>
                        <input type="text" name="title" id="role_name" class="form-control" placeholder="Unesi naziv role" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Spremi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
