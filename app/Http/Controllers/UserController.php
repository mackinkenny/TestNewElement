<?php

namespace App\Http\Controllers;
use App\Position;
use App\Skill;
use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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

    /**
     * edit employee
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

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

    /**
     * update employee
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */

    public function update(Request $request) {
        $this->validator($request->all())->validate();

        User::where('id', $request->id)->update(Arr::except($request->all(), ['_token', 'skills']));
        $user = User::find($request->id);

        $user->skills()->sync(explode(",", $request->skills));

        return redirect()->route('home');
    }

    /**
     * sort and filter employees
     *
     * @param Request $request
     *
     * @return Response
     */

    public function filter(Request $request) {
        $sort = $request->sort;
        $position = $request->position;
        $skill = $request->skill;
        $search = $request->search;

        $users = User::when($sort, function($query, $sort) {
            $query ->orderBy($sort, 'desc');
        })->where(function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search."%")
                ->orWhereHas('position', function ($pos) use ($search){
                    $pos->where('name', 'like', '%'.$search."%");
                })->orWhereHas('skills', function ($skl) use ($search) {
                    $skl->where('name', 'like', '%'.$search.'%');
                });
        });

        if (Auth::check()) {
            $users = $users->where(function ($query) use ($search) {
                $query->Where('email', 'like', '%'.$search."%");
            });
        }

        if ($position)
        {
            $users = $users->where('position_id', $position);
        }
        if ($skill) {
            $users = $users->whereHas('skills', function (\Illuminate\Database\Eloquent\Builder $skl) use ($skill) {
                $skl->where('name', $skill);
            });
        }

        $users = $users->get();

        return response()->json([
            'html' => view('employees', [
                'users' => $users,
            ])->render(),
        ]);
    }
}
