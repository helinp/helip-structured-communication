# Helip\StructuredCommunication

This PHP library provides a set of tools for handling Belgian bank structured communications, ensuring correct data formatting, control number calculations, and validations according to standard practices.

## Features

- **Control Number Calculation**: Generate control numbers for a given 10-digit data input.
- **Data Formatting**: Format structured communication strings in the official pattern `+++ 123 / 1234 / 12345 +++`.
- **Data Validation**: Extensive validation for input data to ensure they conform to expected formats and standards.
- **Error Handling**: Utilizes custom exceptions to manage and report specific error scenarios effectively.

## Requirements

- PHP 8.0 or higher

## Installation

You can install the package via composer:

```bash
composer require helip/structured-communication
```

## Usage

Here's a quick example to get you started:

```php
use StructuredCommunication\StructuredCommunication;

try {
    $communication = new StructuredCommunication('1234567890');
    echo $communication->getFormattedCommunication();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Exceptions

Custom exceptions for handling specific errors:
- `InvalidDataException`
- `InvalidControlNumberException`
- `InvalidCommunicationFormatException`

## Contributing

Contributions are welcome! Please feel free to submit pull requests or create issues for bugs and feature requests.

## License

This project is licensed under the LGPL-3.0 License - see the [LICENSE.md](LICENSE.md) file for details.