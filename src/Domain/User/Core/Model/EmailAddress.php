<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model;

use InvalidArgumentException;

/**
 * Class EmailAddress
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model
 */
class EmailAddress
{
    /**
     * @var string
     */
    private $email;

    /**
     * EmailAddress constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        if (preg_match('/^(.+)@(.+)$/', $email)) {
            $this->email = $email;
        } else {
            throw new InvalidArgumentException("Provided value is not an email address");
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
