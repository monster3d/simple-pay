<?php

namespace App\Http\Middleware;

use Closure;
use \DirectoryIterator;

class CleanerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $filePath  = sprintf("%s/app/", storage_path());
        foreach (new DirectoryIterator($filePath) as $fileInfo) {
            if(!$fileInfo->isDot() && $fileInfo->getExtension() === 'csv') {
                unlink($fileInfo->getPathname());
            }
        }
        return $next($request);
    }
}
