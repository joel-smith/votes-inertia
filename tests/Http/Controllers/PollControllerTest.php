<?php

namespace Tests\Http\Controllers;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PollControllerTest extends TestCase
{

    public User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    use WithFaker;
    public function test_it_can_create_a_poll()
    {
        $testTitle = $this->faker->sentence;

        $response = $this->postJson('/polls', [
            'title' => $testTitle,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/polls');

        $this->assertDatabaseHas('polls', [
            'title' => $testTitle,
        ]);
    }

    public function test_it_can_show_a_poll()
    {
        $poll = Poll::factory()->create();
        $response = $this->getJson(route('polls.show', $poll->id));

        $response->assertStatus(200);

        $response->assertSee($poll->title);

        //TODO: TESTING INERTIA??? or just slam it out???
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

        $response->assertStatus(302);
        $response->assertRedirect('/polls');

        $this->assertDatabaseHas('polls', ['id' => $poll->id, 'title' => $testTitle]);
    }

    public function test_it_can_destroy_a_poll()
    {
        $poll = Poll::factory()->create();


        $response = $this->deleteJson(route('polls.destroy', $poll->id));

        $response->assertStatus(302);
        $response->assertRedirect('/polls');

        $this->assertDatabaseMissing('polls', ['id' => $poll->id]);
    }
}
