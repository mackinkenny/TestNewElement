<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id) {
        $user = User::find($id);

        return view('pages.user.edit', ['user' => $user]);
    }
}
