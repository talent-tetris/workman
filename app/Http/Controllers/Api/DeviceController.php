<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DeviceController extends Controller {
  public function devices(Request $request): JsonResponse {
    $user = $request->user();

    $devices = $user->tokens()
      ->select('id', 'name', 'ip', 'last_used_at')
      ->orderBy('last_used_at', 'DESC')
      ->get();

    $currentToken = $user->currentAccessToken();

    foreach ($devices as $device) {
      $device->hash = Crypt::encryptString($device->id);

      if ($currentToken->id === $device->id) {
        $device->is_current = true;
      }

      unset($device->id);
    }

    return response()->json([
      'status' => true,
      'devices' => $devices,
    ]);
  }

  /**
   * Revoke token by id
   */
  public function deviceDisconnect(Request $request): JsonResponse {
    $request->validate(['hash' => 'required']);

    $user = $request->user();

    $id = (int)Crypt::decryptString($request->hash);

    if (!empty($id)) {
      $user->tokens()->where('id', $id)->delete();
    }

    return response()->json([
      'status' => true,
    ]);
  }
}
