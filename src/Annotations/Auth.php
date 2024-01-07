<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/auth.
 *
 * @link     https://github.com/hyperf-ext/auth
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ext/auth/blob/master/LICENSE
 */

namespace HyperfExt\Auth\Annotations;

use Hyperf\Di\Annotation\AbstractAnnotation;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Auth extends AbstractAnnotation
{
    public function __construct(
        public array $guards = [],
        public bool $passable = false
    ){}
}
