<?php
/**
 * This file is part of DBCSoft Standard Package
 *
 * (c) Ty Huynh <hongty.huynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * **Usages**
 * Link: https://github.com/spatie/laravel-http-logger
 * Add to app/logging.php
 * ```
 * 'http' => [
        'driver' => 'daily',
        'path' => storage_path('logs/http-data-scraping-' . env('APP_ENV') . '-'.get_current_user().'.log'),
        'level' => env('LOG_LEVEL', 'debug'),
        'days' => env('LOG_DAILY_DAYS', 7),
        'permission' => 0777,
    ],
 * ```
 * and modify config http-logger.php
 * ```
 * 'log_writer' => \MicroPhpLibs\RavelSupports\HttpLogCustom::class,
 * ```
 */

namespace MicroPhpLibs\RavelSupports\Http;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\HttpLogger\DefaultLogWriter;

class HttpLogCustom extends DefaultLogWriter
{
    public function logRequest(Request $request)
    {
        $message = $this->formatMessage($this->getMessage($request));
        // Must add config channel http to app/logging.php
        Log::channel('http')->info("IP: " . $request->ip() . " - " . $message);
    }

    public function getMessage(Request $request)
    {
        $files = collect();

        return [
            'method' => strtoupper($request->getMethod()),
            'uri' => $request->getPathInfo(),
            'body' => $request->except(config('http-logger.except')),
            'headers' => ['authorization' => $request->headers->get('authorization')], //all()
            'files' => $files,
        ];
    }
}
