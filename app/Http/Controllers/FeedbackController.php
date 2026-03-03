<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the anonymous feedback form.
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store anonymous feedback (no user association).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
        ]);

        Feedback::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('feedback.create')->with('success', 'Feedback enviado com sucesso. Obrigado!');
    }
}
