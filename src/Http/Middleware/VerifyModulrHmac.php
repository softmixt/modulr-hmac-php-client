<?php

namespace CrowdProperty\ModulrHmacPhpClient\Http\Middleware;

use Carbon\Carbon;
use Closure;
use CrowdProperty\ModulrHmacPhpClient\ModulrApi;
use Illuminate\Support\Facades\Storage;
use Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class VerifyModulrHmac
{
    /**
     * Time in seconds we should allow timestamp of incoming requests to differ from server time.
     *
     * Requests outside this limit will be rejected. This prevents replay attacks.
     */
    protected const DATE_TIME_TOLERANCE = 10;

    protected function parseSignature($signature)
    {
        $return = [];
        $matches = [];

        preg_match_all('/\b(?:[^="]+)/', $signature, $matches);

        foreach (array_chunk($matches[0], 2) as $pair) {
            list($key, $value) = $pair;
            $return[$key] = $value;
        }

        return $return;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $client = new ModulrApi();

        if(env('MODULR_LOG_HEADERS')) {
            $log = new Logger('name');
            $log->pushHandler(new StreamHandler(storage_path('logs/modulr/headers.log'), Logger::INFO));
            $log->info("HEADERS: " . print_r($request->headers->all(), true));
        }

        if (Carbon::parse($request->header('Date'))->diffInSeconds() > self::DATE_TIME_TOLERANCE) {
            \App::abort(401, 'Date value outside expected tolerance');
        }

        $signatureArray = $this->parseSignature($request->header('Authorization'));
        $client->setApiKey($signatureArray['Signature keyId']);
        $client->setHmacSecret(md5(env('MODULR_HOOK_SECRET')));
        $client->setNonce($request->header('X-Mod-Nonce'));
        $client->setTimezone('GMT');
        $client->setDate(Carbon::parse($request->header('Date')));

        if(env('MODULR_LOG_HEADERS')) {
            $log->info('GENERATED AUTH STRING: ' . $client->authorisationString());
            $log->info('MODULR AUTH STRING: ' . $request->header('Authorization'));
        }

        if ($client->authorisationString() != $request->header('Authorization')) {
            \App::abort(401, 'Not authenticated');
        } else {
            return $next($request);
        }
    }

}
