<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (UnauthorizedException $exception, $request) {
            return response()->view('errors.unauthorized', [], 403);
        });
    }
}
