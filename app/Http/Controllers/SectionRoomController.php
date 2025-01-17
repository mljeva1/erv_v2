<?php

namespace App\Http\Controllers;

use App\Models\SectionRoom;
use App\Models\Role;
use Illuminate\Http\Request;

class SectionRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = SectionRoom::all();
        $roles = Role::all();   
        return view('section_role.index', compact('sections', 'roles'));
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
        $validated = $request->validate([
            'naziv' => 'required|string|max:255',
        ]);        
    
        SectionRoom::create($validated);
    
        return redirect()->back()->with('success', 'Sekcija uspješno dodana!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SectionRoom $sectionRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionRoom $sectionRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SectionRoom $sectionRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $section = SectionRoom::findOrFail($id);
        $section->delete();

        return redirect()->back()->with('success', 'Sekcija uspješno obrisana!');
    }
}
