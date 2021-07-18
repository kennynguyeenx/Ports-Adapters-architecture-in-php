<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model;

/**
 * Class User
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model
 */
class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var EmailAddress
     */
    private $email;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;

    /**
     * User constructor.
     * @param EmailAddress $email
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(EmailAddress $email, string $firstName, string $lastName)
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return EmailAddress
     */
    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}
