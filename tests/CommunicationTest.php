<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Helip\StructuredCommunication\StructuredCommunication;
use Helip\StructuredCommunication\Exceptions\InvalidDataException;

class StructuredCommunicationTest extends TestCase
{
    public function testControlNumberCalculationA(): void
    {
        $data = '1234567890';
        $structuredCommunication = new StructuredCommunication($data);
        $expectedControlNumber = '02';

        $this->assertSame($expectedControlNumber, $structuredCommunication->getControlNumber());
    }

    public function testControlNumberCalculationB(): void
    {
        $data = '2024';
        $structuredCommunication = new StructuredCommunication($data);
        $expectedControlNumber = '84';

        $this->assertSame($expectedControlNumber, $structuredCommunication->getControlNumber());
    }

    public function testFormattedCommunication(): void
    {
        $data = '1234567890';
        $structuredCommunication = new StructuredCommunication($data);
        $formattedCommunication = $structuredCommunication->getFormattedCommunication();

        $this->assertSame('+++ 123 / 4567 / 89002 +++', $formattedCommunication);
    }

    public function testInvalidDataException(): void
    {
        $this->expectException(InvalidDataException::class);
        new StructuredCommunication('abc1234567');
    }
}
