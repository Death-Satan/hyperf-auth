<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/auth.
 *
 * @link     https://github.com/hyperf-ext/auth
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ext/auth/blob/master/LICENSE
 */

namespace HyperfExt\Auth\Events;

use HyperfExt\Auth\Contracts\MustVerifyEmail;

class Verified
{
    /**
     * The verified user.
     *
     * @var MustVerifyEmail
     */
    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct(MustVerifyEmail $user)
    {
        $this->user = $user;
    }
}
