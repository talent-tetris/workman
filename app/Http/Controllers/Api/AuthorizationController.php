<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorizationRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthorizationController extends Controller {
  public function login(AuthorizationRequest $request): JsonResponse {
    $user = User::where('username', $request->username)->first();
    $request->authenticate($user);
    $token = $user->createDeviceToken(
      device: $request->deviceName(),
      ip: $request->ip(),
      remember: $request->input('remember', false)
    );
    return response()->json([
      'status' => true,
      'token' => $token,
    ]);
  }

  public function me(): JsonResponse {
    $user = auth()->user();
    return response()->json([
      'status' => true,
      'user' => [
        ...$user->toArray(),
        'has_password' => (bool)$user->password,
      ],
    ]);
  }

  public function logout(): JsonResponse {
    Auth::user()->currentAccessToken()->delete();
    return response()->json([
      'status' => true,
    ]);
  }
}
