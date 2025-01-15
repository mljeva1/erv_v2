<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'sectionRoom'])->get(); // Učitaj povezane podatke
        return view('users.index', compact('users'));
    }
}
