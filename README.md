# Byte Formatter Library

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Version](https://img.shields.io/badge/version-1.0.0-green.svg)](https://github.com/ramazancetinkaya/byte-formatter)
![PHP](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)
[![GitHub stars](https://img.shields.io/github/stars/ramazancetinkaya/byte-formatter.svg?style=social)](https://github.com/ramazancetinkaya/byte-formatter/stargazers)

A PHP library that formats bytes into a human-readable format and vice versa.
<br>
<br>
<a href="https://github.com/ramazancetinkaya/byte-formatter/issues">Report a Bug</a>
·
<a href="https://github.com/ramazancetinkaya/byte-formatter/pulls">New Pull Request</a>

## Overview

This library provides functionality to convert bytes into a human-readable format and vice versa. It allows customization of formatting options and supports error handling for invalid inputs.

## Installation

You can install this library via [Composer](https://getcomposer.org/). Run the following command:

```bash
composer require ramazancetinkaya/byte-formatter
```

## Usage

```php
<?php

require 'vendor/autoload.php'; // Composer autoload file

use ramazancetinkaya\ByteFormatter;

// Create an instance of ByteFormatter
$formatter = new ByteFormatter();

// Format bytes
echo $formatter->format(2048); // Output: 2 KB

// Convert from human-readable size to bytes
echo $formatter->convertToBytes('2 KB'); // Output: 2048
```

## Contributing

Contributions are welcome! Please fork the repository and create a pull request.

## License

This project is licensed under the MIT License. For more details, see the [LICENSE](LICENSE) file.
