<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\User;

use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\AddUserCommand;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\EmailAddress;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\User;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Ports\Outgoing\UserDatabase;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\UserFacade;
use PHPUnit\Framework\TestCase;
use Tests\Unit\LibraryHexagonal\UserTestData;

/**
 * @coversDefaultClass \Kennynguyeenx\LibraryHexagonal\Domain\User\Core\UserFacade
 * Class UserFacadeTest
 * @package Tests\Unit\LibraryHexagonal\Domain\User
 */
class UserFacadeTest extends TestCase
{
    /**
     * @var UserDatabase
     */
    private $database;
    /**
     * @var UserFacade
     */
    private $userFacade;

    public function setUp(): void
    {
        parent::setUp();
        $this->database = new InMemoryUserDatabase();
        $this->userFacade = new UserFacade($this->database);
    }

    /**
     * @test
     * @covers ::handle()
     */
    public function shouldAddNewUser()
    {
        $expectedUser = new User(
            new EmailAddress(UserTestData::kennyEmail()),
            "Kenny",
            "Nguyen"
        );

        $addUserCommand = (new AddUserCommand())
            ->setEmail(UserTestData::kennyEmail())
            ->setFirstName("Kenny")
            ->setLastName("Nguyen");

        $userIdentifier = $this->userFacade->handle($addUserCommand);
        $expectedUser->setId($userIdentifier->getId());

        $this->assertTrue($userIdentifier->getId() > 0);
        $this->assertEquals($expectedUser, $this->database->users[$userIdentifier->getId()]);
    }
}
