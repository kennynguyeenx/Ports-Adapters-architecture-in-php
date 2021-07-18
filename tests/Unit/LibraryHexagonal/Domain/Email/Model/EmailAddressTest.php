<?php

declare(strict_types=1);

namespace Tests\Unit\LibraryHexagonal\Domain\Email\Model;

use InvalidArgumentException;
use Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\EmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Kennynguyeenx\LibraryHexagonal\Domain\Email\Core\Model\EmailAddress
 * Class EmailAddressTest
 * @package Tests\Unit\LibraryHexagonal\Domain\Email\Model
 */
class EmailAddressTest extends TestCase
{
    /**
     * @test
     * @covers ::__construct()
     */
    public function givenCorrectEmailString_whenCreateEmailAddress_thenIsCreated()
    {
        //given
        $emailString = "kenny@test.com";

        //when
        $emailAddress = new EmailAddress($emailString);

        //then
        $this->assertEquals($emailString, $emailAddress->getAsString());
    }

    /**
     * @test
     * @covers ::__construct()
     */
    public function givenInCorrectEmailString_whenCreateEmailAddress_thenThrowException()
    {
        //given
        $notAnEmailString = "not an email";
        $emailWithoutAt = "tom[at]test.com";
        $emailWithoutDomain = "tom@";

        try {
            new EmailAddress($notAnEmailString);
        } catch (InvalidArgumentException $exception) {
            $this->assertSame("Provided value is not an email address", $exception->getMessage());
        }

        try {
            new EmailAddress($emailWithoutAt);
        } catch (InvalidArgumentException $exception) {
            $this->assertSame("Provided value is not an email address", $exception->getMessage());
        }

        try {
            new EmailAddress($emailWithoutDomain);
        } catch (InvalidArgumentException $exception) {
            $this->assertSame("Provided value is not an email address", $exception->getMessage());
        }
    }
}
