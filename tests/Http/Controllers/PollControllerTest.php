<?php

namespace Tests\Http\Controllers;

use App\Models\Option;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PollControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseMigrations;

    public User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_can_create_a_poll()
    {
        $testTitle = $this->faker->sentence;
        $firstOption = $this->faker->sentence;
        $secondOption = $this->faker->sentence;


        $response = $this->postJson('/polls', [
            'title' => $testTitle,
            'options' => [
                ['value' => $firstOption],
                ['value' => $secondOption],
        ]]);

//        $response->assertInertia(function ($inertia) use ($testTitle) {
//            $inertia->component('Polls/Show', [
//                'poll' => Poll::where('title', $testTitle)->first(),
//            ]);
//        });

        $poll = Poll::where('title', $testTitle)->first();

        $this->assertDatabaseHas('polls', [
            'title' => $testTitle,
            ]);

        $this->assertDatabaseHas('options', [
            'poll_id' => $poll->id,
            'value' => $firstOption,
        ]);

        $this->assertDatabaseHas('options', [
            'poll_id' => $poll->id,
            'value' => $secondOption,
        ]);
    }

    public function test_it_can_show_a_poll()
    {
        $poll = Poll::factory()->create();
        $response = $this->getJson(route('polls.show', $poll->id));

        $response->assertStatus(200);

        $response->assertSee($poll->title);

        $response->assertInertia(function ($inertia) use ($poll) {
            $inertia->component('Polls/Show', [
                'poll' => $poll,
            ]);
        });
    }

    public function test_it_can_update_a_poll()
    {
        $poll = Poll::factory()->create();
        $testTitle = $this->faker->sentence;
        $response = $this->putJson(route('polls.update', $poll->id), [
            'title' => $testTitle,
        ]);

        $response->assertInertia(function ($inertia) use ($poll) {
            $inertia->component('Polls/Show', [
                'poll' => $poll,
            ]);
        });

        $this->assertDatabaseHas('polls', ['id' => $poll->id, 'title' => $testTitle]);
    }

    public function test_it_can_destroy_a_poll()
    {
        $poll = Poll::factory()->create();


        $response = $this->deleteJson(route('polls.destroy', $poll->id));

        $response->assertInertia(function ($inertia) {
            $inertia->component('Polls/Index', [
                'polls' => Poll::all(),
            ]);
        });

        $this->assertDatabaseMissing('polls', ['id' => $poll->id]);
    }

    public function test_it_can_vote_on_a_poll()
    {

        $poll = Poll::factory()->create();

        $options = Option::factory()->count(3)->create(
            [
                'poll_id' => $poll->id
            ]
        );

        $response = $this->postJson(route('polls.vote', [$poll->id, $options[0]->id]));


        $response->assertInertia(function ($inertia) use ($poll) {
            $inertia->component('Polls/Results', [
                'poll' => $poll,
            ]);
        });
    }

    public function test_user_cannot_vote_on_same_poll_multiple_times()
    {
        $this->markTestIncomplete();
    }

}
