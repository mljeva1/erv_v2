<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Početna query s eager loadingom
        $query = Task::with(['companyProfile', 'activityType', 'taskStatus']);

        // Filtriranje: Dodaj uvjete za pretragu
        if ($request->has('search') && $request->search != '') {
            $query->where('task_name', 'like', '%' . $request->search . '%')
                ->orWhere('task_code', 'like', '%' . $request->search . '%');
        }

        // Sortiranje: Provjera sortiranja po stupcu i smjeru
        $sortBy = $request->get('sort_by', 'task_name'); // Zadani stupac za sortiranje
        $sortOrder = $request->get('sort_order', 'asc'); // Zadani smjer sortiranja (asc)

        // Primjena sortiranja
        $query->orderBy($sortBy, $sortOrder);

        // Paginacija: Prikaz 10 rezultata po stranici
        $tasks = $query->paginate(10);

        // Vraćanje pogleda s podacima
        return view('tasks.index', compact('tasks', 'sortBy', 'sortOrder'));    
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
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
