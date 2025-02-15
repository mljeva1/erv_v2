@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Dodaj kompaniju</h1>
    <form action="{{ route('company_profiles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="company_name" class="form-label">Naziv kompanije</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="partnership_start_at" class="form-label">Početak partnerstva</label>
            <input type="date" class="form-control" id="partnership_start_at" name="partnership_start_at" required>
        </div>
        <div class="mb-3">
            <label for="partnership_ended" class="form-label">Status partnerstva</label>
            <select class="form-select" id="partnership_ended" name="partnership_ended">
                <option value="0" selected>U tijeku</option>
                <option value="1">Završeno</option>
            </select>
        </div>        
        <button type="submit" class="btn btn-primary">Spremi</button>
    </form>
</div>
@endsection
