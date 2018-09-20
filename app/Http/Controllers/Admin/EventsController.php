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
}
