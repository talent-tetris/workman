<?php

namespace App\Providers;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   */
  public function register(): void {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {

    RateLimiter::for('api', static function (Request $request) {
      return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    });
    RateLimiter::for('login', static function (Request $request) {
      return Limit::perMinute(5)
        ->by(Str::transliterate(implode('|', [
          strtolower($request->input('username')),
          $request->ip()
        ])))
        ->response(static function (Request $request, array $headers): void {
          event(new Lockout($request));

          throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
              'seconds' => $headers['Retry-After'],
              'minutes' => ceil($headers['Retry-After'] / 60),
            ]),
          ]);
        });
    });
    /**
     * Remove all special characters from a string
     */
    Str::macro('onlyWords', static function (string $text): string {
      // \p{L} matches any kind of letter from any language
      // \d matches a digit in any script
      return Str::replaceMatches('/[^\p{L}\d ]/u', '', $text);
    });

    Request::macro('deviceName', function (): string {
      $device = $this->device();

      return implode(' / ', array_filter([
        trim(implode(' ', [$device->getOs('name'), $device->getOs('version')])),
        trim(implode(' ', [$device->getClient('name'), $device->getClient('version')])),
      ])) ?? 'Unknown';
    });
  }
}
