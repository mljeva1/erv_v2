<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Models\SectionRoom;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['role', 'sectionRoom'])->get();
        $sectionRooms = SectionRoom::all();
        return view('users.index', compact('users', 'sectionRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Prikaz svih ulaznih podataka za provjeru
        Log::info('Primljeni podaci:', $request->all());

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|integer|exists:roles,id',
            'section_room_id' => 'required|integer|exists:section_rooms,id',
        ]);

        Log::info('Validirani podaci:', $validated);

        // Ažuriranje korisnika
        $user = User::findOrFail($id);
        $user->update($validated);

        Log::info('Korisnik uspješno ažuriran:', $user->toArray());

        return redirect()->route('users.index')->with('success', 'Korisnik je uspješno ažuriran.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Korisnik uspješno obrisan.');
    }
}