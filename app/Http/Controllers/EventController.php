<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::orderBy('date_time')->paginate(15);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date_time' => ['required', 'date'],
            'location' => ['required', 'string', 'max:500'],
        ]);

        Event::create([
            'name' => $request->name,
            'date_time' => Carbon::parse($request->date_time, 'America/Sao_Paulo'),
            'location' => $request->location,
        ]);

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso.');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date_time' => ['required', 'date'],
            'location' => ['required', 'string', 'max:500'],
        ]);

        $event->update([
            'name' => $request->name,
            'date_time' => Carbon::parse($request->date_time, 'America/Sao_Paulo'),
            'location' => $request->location,
        ]);

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento removido com sucesso.');
    }
}
