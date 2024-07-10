<?php

declare(strict_types=1);

namespace Helip\StructuredCommunication;

use Helip\StructuredCommunication\Utils\CommunicationUtils;

class StructuredCommunication
{
    private string $data;
    private string $controlNumber;

    /**
     * @param string $data (0-9, max 10 digits)
     */
    public function __construct(string $data)
    {
        $data = CommunicationUtils::padToTenDigits($data);
        CommunicationUtils::checkData($data);
        $this->data = $data;
        $this->controlNumber = CommunicationUtils::calculateControlNumber($data);
    }

    /**
     * Get the formatted communication.
     * Example: +++ 123 / 1234 / 12345 +++
     *
     * @return string
     */
    public function getFormattedCommunication(): string
    {
        return CommunicationUtils::format($this->data . $this->controlNumber);
    }

    public function getCommunication(): string
    {
        return $this->data . $this->controlNumber;
    }

    public function getControlNumber(): string
    {
        return $this->controlNumber;
    }

    public function getData(): string
    {
        return $this->data;
    }
}
