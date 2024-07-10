<?php

declare(strict_types=1);

namespace Helip\StructuredCommunication\Utils;

use Helip\StructuredCommunication\Exceptions\InvalidDataException;
use Helip\StructuredCommunication\Exceptions\InvalidControlNumberException;
use Helip\StructuredCommunication\Exceptions\InvalidCommunicationFormatException;

class CommunicationUtils
{
    /**
     * @param string $data
     *
     * @return string a 2 digits control number
     */
    public static function calculateControlNumber(string $data): string
    {
        $control_number = intval($data) % 97;
        $control_number = sprintf('%02d', $control_number);

        if ($control_number === '00') {
            $control_number = '97';
        }
        return $control_number;
    }

    /**
     * Example: +++ 123 / 1234 / 12345 +++
     *
     * @param  string $communication a 12 digits number
     * @throws InvalidDataException
     *
     * @return string
     */
    public static function format(string $communication): string
    {
        if (strlen($communication) !== 12 || !is_numeric($communication)) {
            throw new InvalidCommunicationFormatException("Parameter must be a 12 digits number.");
        }

        $part1 = substr($communication, 0, 3);
        $part2 = substr($communication, 3, 4);
        $part3 = substr($communication, 7, 5);

        return "+++ {$part1} / {$part2} / {$part3} +++";
    }

    /**
     * Check if the data is a 10 digits number with only digits.
     *
     * @param  string $data
     * @throws InvalidDataException
     *
     * @return void
     */
    public static function checkData($data): void
    {
        if (!is_numeric($data) || strlen($data) !== 10) {
            throw new InvalidDataException("Parameter must be a 10 digits number.");
        }
    }

    /**
     * Check if the communication is a 12 digits number with a correct control number.
     *
     * @param  string $communication
     * @throws InvalidCommunicationFormatException
     * @throws InvalidControlNumberException
     *
     * @return void
     */
    public static function checkControlNumber(string $communication): void
    {
        if (strlen($communication) !== 12) {
            throw new InvalidCommunicationFormatException("Parameter must be a 12 digits number.");
        }

        $controlNumber = substr($communication, -2);
        $data = substr($communication, 0, -2);

        if ($controlNumber !== self::calculateControlNumber($data)) {
            throw new InvalidControlNumberException("Control number is not correct.");
        }
    }

    /**
     * Pad a number to 10 digits.
     *
     * @param string $number
     *
     * @return string
     */
    public static function padToTenDigits(string $number): string
    {
        return str_pad($number, 10, '0', STR_PAD_LEFT);
    }
}
