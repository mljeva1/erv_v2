<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyProfiles = CompanyProfile::all(); // Dohvati sve profile
        return view('company_profile.index', compact('companyProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companyProfiles = CompanyProfile::all();
        return view('company_profile.create', compact('companyProfiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validacija
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'partnership_start_at' => 'required|date',
            'partnership_ended' => 'required|boolean',
        ]);

        // Spremanje u bazu
        CompanyProfile::create($validatedData);

        // Redirekcija
        return redirect()->route('company_profiles.index')->with('success', 'Kompanija uspješno dodana!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyProfile $companyProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyProfile $companyProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyProfile $companyProfile)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'partnership_start_at' => 'required|date',
            'partnership_ended' => 'required|boolean',
        ]);
        $validated['partnership_updated_at'] = now();

        $companyProfile->update($request->all());

        return redirect()->route('company_profiles.index')->with('success', 'Profil kompanije je uspješno ažuriran!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProfile $companyProfile)
    {
        $companyProfile->delete();
        return redirect()->route('company_profiles.index')->with('success', 'Profil kompanije je uspješno obrisan!');
    }
}
