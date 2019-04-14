<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bitmyth\PassportClient\Http\Parser;

use Tymon\JWTAuth\Http\Parser\Cookies as JwtCookies;

class Cookies extends JwtCookies
{
    protected $key = 'access_token';
}
