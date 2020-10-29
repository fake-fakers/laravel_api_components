<?php

declare(strict_types=1);

namespace FakeFakers\ApiComponents\Http\Middleware;

/**
 * Class PreferJson
 * @package FakeFakers\ApiComponents\Http\Middleware
 */
class PreferJson
{
    private const JSON_MIME = 'application/json';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param bool $force ability to
     * @return mixed
     */
    public function handle($request, \Closure $next, $force = false)
    {
        $force = (bool)$force;

        if ($force) {
            $request->headers->set('Accept', self::JSON_MIME);
        } else {
            $accept = $request->header('Accept');
            if (empty($accept) || '*/*' === $accept) {
                $request->headers->set('Accept', self::JSON_MIME);
            }
        }

        return $next($request);
    }
}