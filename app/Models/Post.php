<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  use HasFactory, HasUuids;

  protected $fillable = [
    'user_id',
    'body'
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function images() {
    return $this->hasMany(File::class);
  }
}
