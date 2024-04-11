<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        "/api/login",
        "/api/user/update",
        "/api/single",
        "/api/cart",
        "/api/cart/check",
        "/api/hashcheck",
        "/api/Kobs",
        "/api/mycourse",
        "/api/license",
        "/api/comment/create",
        "/api/comments",
        "/api/cart/delete",
        "/api/check_code",
        "/api/payment"
    ];
}
