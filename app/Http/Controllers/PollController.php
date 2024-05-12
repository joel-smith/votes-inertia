<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Poll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::all();
        return Inertia::render('Polls/Index', ['polls' => $polls]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Poll::create($request->only('title'));
        return redirect()->route('polls.index');
    }

    public function show(Poll $poll)
    {
//        dd($poll->toArray());
        return Inertia::render('Polls/Show', ['poll' => $poll->load('options')]);
    }

    public function update(Request $request, Poll $poll)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $poll->update($request->only('title'));
        return redirect()->route('polls.index');
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();
        return redirect()->route('polls.index');
    }

    public function vote(Poll $poll, Option $option)
    {
//        $poll->options()->updateExistingPivot($option->id, ['votes' => $option->pivot->votes + 1]);

//        return redirect()->route('polls.show', $poll);
        return Inertia::render('polls.results', ['poll' => $poll]);
    }
}
