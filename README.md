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

## 🚀 Give this Project a Star

If you found this library useful or would like to support it, please consider giving it a star on GitHub! Your support helps improve and maintain the project. Thank you! 🌟

## Overview

This library provides functionality to convert bytes into a human-readable format and vice versa. It allows customization of formatting options and supports error handling for invalid inputs.

## Installation

You can install the `ByteFormatter` library using [Composer](https://getcomposer.org/). Run the following command in your terminal:

```bash
composer require ramazancetinkaya/byte-formatter
```

## Usage

Here is a simple example of how to use the `ByteFormatter` class:

```php
<?php

require 'vendor/autoload.php'; // Composer autoload file

use ramazancetinkaya\ByteFormatter;

// Create an instance of ByteFormatter
$formatter = new ByteFormatter();

// Format bytes
echo $formatter->formatBytes(123456789); // Outputs: 117.74 MB

// Convert from human-readable size to bytes
echo $formatter->parseFormattedValue('1.5 GB'); // Outputs: 1610612736
```

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue for any enhancements or bug fixes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
