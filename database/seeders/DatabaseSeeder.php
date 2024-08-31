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
//    $users = User::factory(24)->create();
//    foreach ($users as $user) {
//      $posts = Post::factory(rand(0, 4))->create([
//        'user_id' => $user['id']
//      ]);
//    }
//    User::factory()->create([
//      'name' => 'Frog King Millionaire',
//      'email' => 'thatoranzhevyy@gmail.com',
//      'username' => 'test',
//      'password' => Hash::make('password'),
//    ]);

    $users = [
      [
        'name' => 'Bogenbay Millionfrog Bayzharasov 🐸💸',
        'username' => 'frog_king_millionaire',
        'email' => 'frogking@millionairbrainless.com',
        'password' => Hash::make('ribbitriches'),
      ],
      [
        'name' => 'Tolya Macaroni_Flame Filiuk 🍜📺',
        'username' => 'anime_pasta_master',
        'email' => 'noodleanimeking@slurpandwatch.jp',
        'password' => Hash::make('animelover1'),
      ],
      [
        'name' => 'Vladislav BirthdayQueen Polyakov 🥳',
        'username' => 'hoppy_bday_to_me',
        'password' => Hash::make('itsmybday'),
      ],
      [
        'name' => 'Angelina ColorSplash Avemarit 🎨✨',
        'username' => 'angelsin',
        'email' => 'artistequeen@newprofiles.rts',
        'password' => Hash::make('creativegal'),
      ],
      [
        'name' => 'Gospodin Mysterio Fedotov 🕵️‍♂️',
        'username' => 'phantom_lord',
        'password' => Hash::make('mysteryman'),
      ],
      [
        'name' => 'Sanek SuperSan LGRNON ✋',
        'username' => 'sanya_star',
        'password' => Hash::make('sanyapower'),
      ],
      [
        'name' => 'Matik FroggySan 🐸❤️',
        'username' => 'froggygirl_fan',
        'password' => Hash::make('froglove34'),
      ],
    ];
    foreach ($users as $user) {
      User::factory()->create($user);
    }
  }
}
