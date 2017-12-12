<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
  /**
   * Seed the posts table
   */
  public function run()
  {
    // Pull all the tag names from the file
    factory(Post::class, 20)->create();
  }
}