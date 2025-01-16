@extends('layouts.app')

@section('title', 'Početna - Evidencija radnog vremena')

@section('content')
<div class="text-center align-middle pt-5">
    @guest
        <h2>Dobrodošli u sustav Evidencije radnog vremena!</h2>
        <p>Ovdje možete pratiti radno vrijeme zaposlenika, zadatke i generirati izvještaje.</p>
        <p>Prijavite se kako bi vidjeli sučelje</p>
    @else
        <h2>Dobrodošao {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
    @endguest
</div>
@endsection