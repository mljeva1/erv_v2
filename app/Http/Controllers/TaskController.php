<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->query('sort_by', 'task_code');
        $sortOrder = $request->query('sort_order') === 'desc' ? 'desc' : 'asc';
        $status = $request->query('status'); // Dohvati status iz upitnog parametra

        $tasks = Task::query()
            ->when(in_array($sortBy, ['task_code', 'task_name']), function ($query) use ($sortBy, $sortOrder) {
                return $query->orderBy($sortBy, $sortOrder);
            })
            ->when($sortBy === 'company_name', function ($query) use ($sortOrder) {
                return $query->orderByRaw("(SELECT company_name FROM company_profiles WHERE company_profiles.id = tasks.company_profile_id LIMIT 1) {$sortOrder}");
            })
            ->when($sortBy === 'activity_name', function ($query) use ($sortOrder) {
                return $query->orderByRaw("(SELECT name FROM activity_types WHERE activity_types.id = tasks.activity_type_id LIMIT 1) {$sortOrder}");
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('tasks.task_status_id', $status); // Filtriranje po statusu
            })
            ->paginate(9);

        $totalTasks = Task::count();
        $users = User::all();

        return view('tasks.index', compact('tasks', 'sortBy', 'sortOrder', 'users', 'status', 'totalTasks'));
    }


    public function assignUsers(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $request->validate([
            'users' => 'array',
            'users.*' => 'exists:users,id',
        ]);

        // Sinkronizacija korisnika (dodavanje i uklanjanje)
        $task->users()->sync($request->users);

        return redirect()->route('tasks.index')->with('success', 'Korisnici su uspješno ažurirani za zadatak.');
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
