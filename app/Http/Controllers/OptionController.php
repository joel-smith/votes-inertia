<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Poll;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class OptionController extends Controller
{
    public function index(Poll $poll)
    {
        $options = $poll->options;
        return Inertia::render('Options/Index', ['options' => $options]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poll_id' => 'required|exists:polls,id',
        ]);
        $poll = Poll::find($request->poll_id);
        $poll->options()->create($request->only('title'));
        return redirect()->route('polls.show', $poll);
    }

    public function show(Poll $poll, Option $option)
    {
        abort_unless($option->poll_id === $poll->id, Response::HTTP_NOT_FOUND);

        return inertia('Options/Show', ['option' => $option]);
    }

    public function destroy(Option $option)
    {
        $option->delete();
        return redirect()->route('polls.show', $option->poll);
    }
}
