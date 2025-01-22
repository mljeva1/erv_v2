<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\CompanyProfile;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Pretraga korisnika
        $users = User::where('name', 'like', "%$query%")
            ->orWhere('first_name', 'like', "%$query%")
            ->orWhere('last_name', 'like', "%$query%")
            ->get();

        // Pretraga zadataka
        $tasks = Task::where('task_name', 'like', "%$query%")
            ->orWhere('task_code', 'like', "%$query%")
            ->get();

        // Pretraga kompanija
        $companies = CompanyProfile::where('company_name', 'like', "%$query%")
            ->get();

        // Vraćamo rezultate u view
        return view('search.results', compact('users', 'tasks', 'companies', 'query'));
    }
}