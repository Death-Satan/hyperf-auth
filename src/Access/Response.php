<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/auth.
 *
 * @link     https://github.com/hyperf-ext/auth
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ext/auth/blob/master/LICENSE
 */

namespace HyperfExt\Auth\Access;

use Hyperf\Contract\Arrayable;
use HyperfExt\Auth\Exceptions\AuthorizationException;

class Response implements Arrayable
{
    /**
     * Create a new response.
     *
     * @param mixed $code
     */
    public function __construct(protected bool $allowed,protected  ?string $message = null,protected  $code = null){}

    /**
     * Get the string representation of the message.
     */
    public function __toString(): string
    {
        return (string) $this->message();
    }

    /**
     * Create a new "allow" Response.
     *
     * @param mixed $code
     */
    public static function allow(?string $message = null, $code = null): Response
    {
        return new self(true, $message, $code);
    }

    /**
     * Create a new "deny" Response.
     *
     * @param mixed $code
     */
    public static function deny(?string $message = null, $code = null): Response
    {
        return new self(false, $message, $code);
    }

    /**
     * Determine if the response was allowed.
     */
    public function allowed(): bool
    {
        return $this->allowed;
    }

    /**
     * Determine if the response was denied.
     */
    public function denied(): bool
    {
        return ! $this->allowed();
    }

    /**
     * Get the response message.
     */
    public function message(): ?string
    {
        return $this->message;
    }

    /**
     * Get the response code / reason.
     *
     * @return mixed
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * Throw authorization exception if response was denied.
     *
     * @return $this
     * @throws AuthorizationException
     */
    public function authorize(): Response
    {
        if ($this->denied()) {
            throw (new AuthorizationException($this->message(), $this->code()))
                ->setResponse($this);
        }

        return $this;
    }

    /**
     * Convert the response to an array.
     */
    public function toArray(): array
    {
        return [
            'allowed' => $this->allowed(),
            'message' => $this->message(),
            'code' => $this->code(),
        ];
    }
}
