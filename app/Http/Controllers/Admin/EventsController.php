<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EventsController extends Controller
{
    public function index()
    {
    	$events = Event::all(); // Вытаскиваем все категории из таблицы

    	return view('admin.events.index', [
    		'events' => $events
    	]);
    }

    public function create()
    {
    	return view('admin.events.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required|unique:events'	// Валидация, название обязательно, уникально для таблицы мероп.
    	]);

    	Event::create($request->all()); // Создаём мероприятие

    	return redirect()->route('events.index'); // Возврат на листинг
    }

    public function edit($id)
    {
    	$event = Event::find($id);

    	return view('admin.events.edit', [
    		'event' => $event
    	]);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
    		'title' => 'required|unique:events'	// Валидация, название обязательно, уникально для таблицы мероп.
    	]);

    	$event = Event::find($id);
    	$event->update($request->all());

    	return redirect()->route('events.index');
    }

    public function destroy($id)
    {
    	$event = Event::find($id)->delete();

    	return redirect()->route('events.index');
    }
}
