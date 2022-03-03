<?php

namespace App\Http\Controllers;

use App\Position;
use App\Skill;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $positions = Position::all();
        $skills = Skill::all();

        return view('home', ['users' => $users, 'positions' => $positions, 'skills' => $skills]);
    }
}
