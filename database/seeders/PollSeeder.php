<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Poll;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polls = Poll::factory(5)->create();

        $polls->each(function ($poll) {
            Option::factory()->count(3)->create(['poll_id' => $poll->id]);
        });
    }
}
