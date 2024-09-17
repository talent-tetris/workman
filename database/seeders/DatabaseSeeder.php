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
    }
    User::factory()->create([
      'name' => 'Frog King Millionaire',
      'email' => 'thatoranzhevyy@gmail.com',
      'username' => 'test',
      'password' => Hash::make('password'),
      'password_expired' => true
    ]);

//    $users = [
//      [
//        'name' => 'Bogenbay Millionfrog Bayzharasov 🐸💸',
//        'username' => 'frog_king_millionaire',
//        'email' => 'frogking@millionairbrainless.com',
//        'password' => Hash::make('ribbitriches'),
//        'password_expired' => true
//      ],
//      [
//        'name' => 'Tolya Macaroni_Flame Filiuk 🍜📺',
//        'username' => 'anime_pasta_master',
//        'email' => 'noodleanimeking@slurpandwatch.jp',
//        'password' => Hash::make('animelover1'),
//        'password_expired' => true
//      ],
//      [
//        'name' => 'Vladislav BirthdayQueen Polyakov 🥳',
//        'username' => 'hoppy_bday_to_me',
//        'password' => Hash::make('itsmybday'),
//        'password_expired' => true
//      ],
//      [
//        'name' => 'Angelina ColorSplash Avemarit 🎨✨',
//        'username' => 'angelsin',
//        'email' => 'artistequeen@newprofiles.rts',
//        'password' => Hash::make('creativegal'),
//        'password_expired' => true
//      ],
//      [
//        'name' => 'спублуп 🐸️',
//        'username' => 'mordecai',
//        'password' => Hash::make('mysteryman'),
//        'password_expired' => true
//      ],
//      [
//        'name' => 'Gospodin Mysterio Fedotov 🕵️‍♂️',
//        'username' => 'phantom_lord',
//        'password' => Hash::make('mysteryman'),
//        'password_expired' => true
//      ],
//      [
//        'name' => 'Sanek SuperSan LGRNON ✋',
//        'username' => 'sanya_star',
//        'password' => Hash::make('sanyapower'),
//        'password_expired' => true
//      ],
//      [
//        'name' => 'Matik FroggySan 🐸❤️',
//        'username' => 'froggygirl_fan',
//        'password' => Hash::make('froglove34'),
//        'password_expired' => true
//      ],
//    ];
//    foreach ($users as $user) {
//      User::factory()->create($user);
//    }
  }
}
