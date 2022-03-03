<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:skills'],
        ]);
    }

    /**
     * Skills list page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() {
        $skills = Skill::all();

        return view('pages.skill.list', ['skills' => $skills]);
    }

    /**
     * create skill
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function create() {
        return view('pages.skill.create');
    }

    /**
     * store skill
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */

    public function store(Request $request) {
        $this->validator($request->all())->validate();

        Skill::create([
            'name' => $request->name,
        ]);

        return redirect()->route('skills/index');
    }

    /**
     * edit skill
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function edit($id) {
        $skill = Skill::find($id);

        return view('pages.skill.edit', ['skill' => $skill]);
    }

    /**
     * update skill
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */

    public function update(Request $request) {
        $this->validator($request->all())->validate();

        Skill::where('id', $request->id)->update(Arr::except($request->all(), ['_token']));

        return redirect()->route('skills/index');
    }
}
