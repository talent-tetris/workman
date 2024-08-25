<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   */
  public function run(): void {
    User::factory(5)
      ->hasPosts(rand(2, 4))
      ->create()
      ->each(function ($user) {
        $user->posts->each(function ($post) {
          $images = Image::factory(rand(1, 5))->make();
          $post->images()->saveMany($images);
        });
      });
//    User::factory(10)->create();

    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
      'username' => 'test',
    ]);
  }
}
