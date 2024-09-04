<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller {
  /**
   * Update the user's password.
   * @throws ValidationException
   */
  public function password(Request $request): JsonResponse {
    $request->validate([
      'current_password' => ['required', 'string', 'min:8', 'max:100'],
      'password' => ['required', 'string', 'min:8', 'max:100', 'confirmed'],
    ]);

    $user = $request->user();
    abort_if(!$user->password, 403, __('Access denied.'));

    if (!Hash::check($request->current_password, $user->password)) {
      throw ValidationException::withMessages([
        'current_password' => __('auth.password'),
      ]);
    }

    $user->update([
      'password' => Hash::make($request->password),
      'password_expired' => false
    ]);

    return response()->json([
      'status' => true,
    ]);
  }
}
