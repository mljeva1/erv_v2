<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evidencija;
use App\Models\ActivityType;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class EvidencijaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evidencije = Evidencija::where('user_id', Auth::id())->with('task', 'activityType')->get();
        return view('evidencija.index', compact('evidencije'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks = Task::all();
        $activityTypes = ActivityType::all();
        return view('evidencija.create', compact('tasks', 'activityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'datum' => 'required|date',
            'sati' => 'required|numeric|min:0.25|max:24',
            'opis' => 'nullable|string',
            'task_id' => 'nullable|exists:tasks,id',
            'activity_type_id' => 'nullable|exists:activity_types,id',
        ]);

        Evidencija::create([
            'user_id' => Auth::id(),
            'task_id' => $request->task_id,
            'activity_type_id' => $request->activity_type_id,
            'datum' => $request->datum,
            'sati' => $request->sati,
            'opis' => $request->opis,
        ]);

        return redirect()->route('evidencija.index')->with('success', 'Evidencija dodana!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
