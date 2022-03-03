<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:positions'],
        ]);
    }

    /**
     * Positions list page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() {
        $positions = Position::all();

        return view('pages.position.list', ['positions' => $positions]);
    }

    /**
     * create position
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function create() {
        return view('pages.position.create');
    }

    /**
     * store position
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */

    public function store(Request $request) {
        $this->validator($request->all())->validate();

        Position::create([
            'name' => $request->name,
        ]);

        return redirect()->route('positions/index');
    }

    /**
     * edit position
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function edit($id) {
        $position = Position::find($id);

        return view('pages.position.edit', ['position' => $position]);
    }

    /**
     * update position
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */

    public function update(Request $request) {
        $this->validator($request->all())->validate();

        Position::where('id', $request->id)->update(Arr::except($request->all(), ['_token']));

        return redirect()->route('positions/index');
    }
}
