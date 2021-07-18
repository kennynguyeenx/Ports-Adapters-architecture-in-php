<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model;

use InvalidArgumentException;

/**
 * Class EmailAddress
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model
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
    public function getAsString(): string
    {
        return $this->email;
    }
}
