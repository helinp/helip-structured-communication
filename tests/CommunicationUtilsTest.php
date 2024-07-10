<?php

use PHPUnit\Framework\TestCase;
use Helip\StructuredCommunication\Utils\CommunicationUtils;
use Helip\StructuredCommunication\Exceptions\InvalidDataException;
use Helip\StructuredCommunication\Exceptions\InvalidControlNumberException;
use Helip\StructuredCommunication\Exceptions\InvalidCommunicationFormatException;

class CommunicationUtilsTest extends TestCase
{
    public function testCalculateControlNumber()
    {
        $this->assertEquals('97', CommunicationUtils::calculateControlNumber('0000000000'));
        $this->assertEquals('93', CommunicationUtils::calculateControlNumber('0909337554'));
    }

    public function testFormat()
    {
        $this->assertEquals('+++ 123 / 4567 / 89002 +++', CommunicationUtils::format('123456789002'));
    }

    public function testFormatWithInvalidData()
    {
        $this->expectException(InvalidCommunicationFormatException::class);
        CommunicationUtils::format('1234567890');
    }

    public function testCheckDataValid()
    {
        $this->assertNull(CommunicationUtils::checkData('1234567890'));
    }

    public function testCheckDataInvalid()
    {
        $this->expectException(InvalidDataException::class);
        CommunicationUtils::checkData('abc1234567');

        $this->expectException(InvalidDataException::class);
        CommunicationUtils::checkData('1234567890');
    }

    public function testCheckControlNumberValid()
    {
        $this->assertNull(CommunicationUtils::checkControlNumber('123456789002'));
    }

    public function testCheckControlNumberInvalid()
    {
        $this->expectException(InvalidControlNumberException::class);
        CommunicationUtils::checkControlNumber('123456789099');
    }
}
