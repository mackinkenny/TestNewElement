<?php

namespace App\Http\Controllers;
use App\Position;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\DocBlock\Description;

class UserController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:positions'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($data['id'])],
            'phone' => ['required', 'string', 'max:18',  Rule::unique('users', 'phone')->ignore($data['id'])],
            'position_id' => ['required'],
            'skills' => ['required'],
        ]);
    }

    public function edit($id) {
        $user = User::find($id);
        $skills = Skill::select('id', 'name')->get();
        $positions = Position::select('id', 'name')->get();

        return view('pages.user.edit',
            [
                'user' => $user,
                'skills' => $skills,
                'positions' => $positions
            ]);
    }

    public function update(Request $request) {
        $this->validator($request->all())->validate();

        User::where('id', $request->id)->update(Arr::except($request->all(), ['_token', 'skills']));
        $user = User::find($request->id);

        $user->skills()->sync(explode(",", $request->skills));

        return redirect()->route('home');
    }
}
