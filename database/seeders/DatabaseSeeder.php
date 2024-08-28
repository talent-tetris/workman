<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   */
  public function run(): void {
    $users = User::factory(24)->create();
    foreach ($users as $user) {
      $posts = Post::factory(rand(0, 4))->create([
        'user_id' => $user['id']
      ]);
      foreach ($posts as $post) {
        Image::factory(rand(0, 5))->create([
          'post_id' => $post['id']
        ]);
      }
    }

    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
      'username' => 'test',
    ]);
  }
}
