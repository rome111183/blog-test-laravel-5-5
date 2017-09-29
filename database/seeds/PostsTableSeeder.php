<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      for($i=0;$i<10000;$i++ )
          {
              $status = ['unpublish', 'publish'];
              $k = array_rand($status);
              $title = $faker->unique()->text($maxNbChars = rand(10,100));
              \App\Post::create( [
                  'title' => $title,
                  'slug' => str_slug($title, '_'),
                  'contents' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                  'status' => $status[$k],
                  'owner_id' => \App\User::all()->random()->id,
                  'updated_user_id' => \App\User::all()->random()->id,
              ] );

          }
    }
}
