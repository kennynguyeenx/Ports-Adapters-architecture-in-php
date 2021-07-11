<?php

declare(strict_types=1);

namespace Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model;

/**
 * Class AddUserCommand
 * @package Kennynguyeenx\PortsAndAdapters\Domain\User\Core\Model
 */
class AddUserCommand
{
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $lastName;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return AddUserCommand
     */
    public function setFirstName(string $firstName): AddUserCommand
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return AddUserCommand
     */
    public function setEmail(string $email): AddUserCommand
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return AddUserCommand
     */
    public function setLastName(string $lastName): AddUserCommand
    {
        $this->lastName = $lastName;
        return $this;
    }
}
