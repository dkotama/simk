<?php

use Illuminate\Database\Seeder;
use App\Conference;

class ReviewQuestionFirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $temp = Conference::first();

      DB::table('review_questions')->insert([
        'conference_id' => $temp->id;
     ]);
    }
}
