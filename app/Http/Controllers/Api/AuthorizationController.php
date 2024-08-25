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
    $user = Auth::user();
    $request = Request::create('oauth/token', 'POST', [
      'grant_type' => 'password',
      'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
      'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
      'username' => $request->username,
      'password' => $request->password,
      'scope' => '',
    ]);
    $result = app()->handle($request);
    $response = json_decode($result->getContent(), true);
    $user['token'] = $response;
    return response()->json([
      'status' => true,
      'token' => $response,
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

  public function refresh(RefreshTokenRequest $request): JsonResponse {
    $request = Request::create('oauth/token', 'POST', [
      'grant_type' => 'refresh_token',
      'refresh_token' => $request->refresh_token,
      'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
      'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
      'scope' => '',
    ]);
    $result = app()->handle($request);
    $response = json_decode($result->getContent(), true);
    return response()->json([
      'success' => true,
      'token' => $response,
    ]);
  }

  public function logout(): JsonResponse {
    Auth::user()->tokens()->delete();
    return response()->json([
      'status' => true,
    ]);
  }
}
