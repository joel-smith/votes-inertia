<?php

namespace App\Http\Controllers;

use App\Events\PollVoted;
use App\Models\Option;
use App\Models\Poll;
use App\Models\PollUserOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'title' => 'required|string|min:3|max:255',
            'options' => 'required|array|min:2',
            'options.*.value' => 'required|string|min:2|max:255',
        ]);

        $poll = Poll::create($request->only('title'));
        $poll->user_id = auth()->user()->id;
        $poll->save();

        foreach ($request->options as $option) {
            Option::create([
                'poll_id' => $poll->id,
                'value' => $option['value'],
                ]
            );
        }

        return Inertia::render('Polls/Show', ['poll' => $poll->load('options')]);
//        return redirect()->route('polls.show', $poll);
    }

    public function show(Poll $poll)
    {
        if ($this->isExistingVote($poll)) {
            return Inertia::render('Polls/Results', [
                'poll' => $poll->load('options')
            ]);
        }

        return Inertia::render('Polls/Show', ['poll' => $poll->load('options')]);
    }

    public function update(Request $request, Poll $poll)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $poll->update($request->only('title'));
        return Inertia::render('Polls/Show', ['poll' => $poll->load('options')]);
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();
        return Inertia::render('Polls/Index');
    }

    public function vote(Poll $poll, Option $option)
    {
        $user = auth()->user();

        if ($this->isExistingVote($poll)) {
            return redirect()->route('polls.results', $poll);
        }

        $option->increment('votes');
        $option->save();

        PollUserOption::create([
            'poll_id' => $poll->id,
            'option_id' => $option->id,
            'user_id' => $user->id,
        ]);

        event(new PollVoted($user, $poll, $option));
        return redirect()->route('polls.results', $poll);
    }

    public function results(Poll $poll)
    {
        return Inertia::render('Polls/Results', [
            'poll' => $poll->load('options')
        ]);
    }

    private function isExistingVote($poll)
    {
        $user = auth()->user();
        $existingVote = PollUserOption::where('poll_id', $poll->id)->where('user_id', $user->id)->first();
        return $existingVote;
    }
}
