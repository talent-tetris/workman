<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model {
  use HasFactory, HasUuids;

  protected $fillable = [
    'post_id',
    'collection',
    'height',
    'width',
    'file_path',
    'content_type',
    'file_name',
    'original_name',
    'description',
    'file_size',
  ];

  public function post() {
    return $this->belongsTo(Post::class);
  }
}
