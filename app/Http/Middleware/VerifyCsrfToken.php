<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'common/post/grapes_update',
        'common/post/grapes_load_now',
        'common/page/grapes_update',
        'common/page/grapes_load_now'
    ];
}
