<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with calendar of events.
     */
    public function index(Request $request)
    {
        $month = (int) $request->get('month', now()->month);
        $year = (int) $request->get('year', now()->year);

        $current = Carbon::createFromDate($year, $month, 1, 'America/Sao_Paulo');
        $start = $current->copy()->startOfMonth()->setTimezone('UTC');
        $end = $current->copy()->endOfMonth()->endOfDay()->setTimezone('UTC');

        $events = Event::whereBetween('date_time', [$start, $end])->orderBy('date_time')->get();
        $eventsByDay = $events->groupBy(function ($event) {
            return $event->date_time->setTimezone('America/Sao_Paulo')->day;
        });

        $lastDay = $current->copy()->endOfMonth()->day;
        $firstWeekday = $current->dayOfWeek; // 0 = domingo
        $weeks = [];
        $week = [];
        for ($i = 0; $i < $firstWeekday; $i++) {
            $week[] = ['day' => null, 'events' => []];
        }
        for ($day = 1; $day <= $lastDay; $day++) {
            $week[] = [
                'day' => $day,
                'events' => $eventsByDay->get($day, collect())->values()->all(),
            ];
            if (count($week) === 7) {
                $weeks[] = $week;
                $week = [];
            }
        }
        if (count($week) > 0) {
            while (count($week) < 7) {
                $week[] = ['day' => null, 'events' => []];
            }
            $weeks[] = $week;
        }

        $prev = $current->copy()->subMonth();
        $next = $current->copy()->addMonth();

        return view('dashboard', [
            'current' => $current,
            'weeks' => $weeks,
            'prevMonth' => $prev,
            'nextMonth' => $next,
        ]);
    }
}
