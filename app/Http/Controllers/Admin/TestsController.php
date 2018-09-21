<?php

namespace App\Http\Controllers\Admin;

use App\Test;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::all(); // Вытаскиваем все категории из таблицы

        return view('admin.tests.index', [
            'tests' => $tests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::pluck('title', 'id')->all();

        return view('admin.tests.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:tests',
            'image' =>  'nullable|image',
            'date'  => 'required',
            'content' => 'required'
        ]);

        $test = Test::add($request->all());
        $test->uploadImage($request->file('image'));
        $test->setEvent($request->get('event_id'));
        $test->toggleStatus($request->get('status'));
        $test->toggleFeatured($request->get('is_featured'));

        return redirect()->route('tests.index'); // Возврат на листинг
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = Test::find($id);
        $events = Event::pluck('title', 'id')->all();

        return view('admin.tests.edit', compact('test', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $test = Test::find($id);

        $this->validate($request, [
            'title' =>  [
                'required',
                Rule::unique('tests')->ignore($test->id)
            ],
            'image' =>  'nullable|image',
            'date'  => 'required',
            'content' => 'required'
        ]);

        $test->edit($request->all());
        $test->uploadImage($request->file('image'));
        $test->setEvent($request->get('event_id'));
        $test->toggleStatus($request->get('status'));
        $test->toggleFeatured($request->get('is_featured'));

        return redirect()->route('tests.index'); // Возврат на листинг
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::find($id)->remove();

        return redirect()->route('tests.index');
    }
}
