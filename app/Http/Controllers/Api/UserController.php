<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index() {
    return response()->json([
      'status' => true,
      'users' => User::paginate(25),
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show($username) {
    $user = User::where('username', $username)->first();
    return response()->json([
      'status' => true,
      'user' => $user,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user) {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user) {
    //
  }
}
