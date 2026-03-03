<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrador');
    }

    /**
     * Listar feedbacks mais recentes (ordem decrescente de data/hora).
     */
    public function index()
    {
        $feedbacks = Feedback::orderByDesc('created_at')->paginate(20);
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Avaliar feedback como positivo ou negativo.
     */
    public function rate(Request $request, Feedback $feedback)
    {
        $request->validate([
            'rating' => ['required', 'in:positivo,negativo'],
        ]);

        $feedback->update(['rating' => $request->rating]);

        return redirect()->route('admin.feedbacks.index')->with('success', 'Avaliação registrada.');
    }
}
