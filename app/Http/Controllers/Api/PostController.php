<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;

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
   * Show the form for creating a new resource.
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    //
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
