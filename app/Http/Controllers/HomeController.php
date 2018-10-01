<?php

namespace App\Http\Controllers;

use App\Test;
use App\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::paginate(3);
        $popularTests = Test::orderBy('views', 'desc')->take(3)->get();
        $featuredTests = Test::where('is_featured', 1)->take(3)->get();
        $recentTests = Test::orderBy('date', 'desc')->take(4)->get();
        dd($recentTests);

        return view('pages.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $test = Test::where('slug', $slug)->firstOrFail();

        return view('pages.blog', compact('test'));
    }

    public function event($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $tests = $event->tests()->paginate(2);

        return view('pages.list', compact('tests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
