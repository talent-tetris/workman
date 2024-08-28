<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
  use HasFactory, HasUuids;

  protected $fillable = [
    'post_id',
    'path',
    'caption',
  ];

  public function post() {
    return $this->belongsTo(Post::class);
  }
}
