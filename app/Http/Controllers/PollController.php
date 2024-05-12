<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Poll;
use App\Models\PollUserOption;
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

    public function vote(Request $request,Poll $poll, Option $option)
    {
        $user = auth()->user();
        $existingVote= PollUserOption::where('poll_id', $poll->id)->where('user_id', $user->id)->first();

        if ($existingVote) {
            return redirect()->back()->withErrors(['You have already voted']);
        }

        PollUserOption::create([
            'poll_id' => $poll->id,
            'option_id' => $option->id,
            'user_id' => $user->id,
        ]);

        return Inertia::render('polls.results', ['poll' => $poll]);
    }
}
