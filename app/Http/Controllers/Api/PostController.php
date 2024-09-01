<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePostBlogRequest;
use App\Models\File;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController {
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request) {
    $perPage = $request->query('per_page', 15);
    $posts = \App\Models\Post::with('user')
      ->with('images')
      ->orderBy('created_at', 'DESC')
      ->paginate($perPage);
    return response()->json([
      'status' => true,
      'posts' => $posts,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePostBlogRequest $request) {
    $body_text = $request->body;
    $post = Post::query()->create(attributes: [
      'body' => $body_text ?? '',
      'user_id' => auth()->user()->id
    ]);
    if ($request->hasFile('images')) {
      foreach ($request->file('images') as $file) {
        $name = $file->hashName();
        Storage::disk('public')->put("posts/{$post->id}", $file);

        $content_type = $file->getClientMimeType();
        $image_size = [];
        if (str_contains($content_type, 'image/')) {
          $ar_image_size = getimagesize($file);
          $image_size['width'] = $ar_image_size[0];
          $image_size['height'] = $ar_image_size[1];
        }
        File::create([
          ...$image_size,
          'post_id' => $post->id,
          'file_name' => "{$name}",
          'original_name' => $file->getClientOriginalName(),
          'content_type' => $content_type,
          'file_path' => "posts/{$post->id}",
          'collection' => 'posts',
          'file_size' => $file->getSize(),
        ]);
      }
    }

    return response()->json([
      'status' => true,
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post) {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post) {
    //
  }
}
