# Byte Formatter Library

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777bb4?style=for-the-badge&logo=php&logoColor=white)
[![Packagist](https://img.shields.io/packagist/v/ramazancetinkaya/byte-formatter?style=for-the-badge&color=34C759)](https://packagist.org/packages/ramazancetinkaya/byte-formatter)
![Downloads](https://img.shields.io/packagist/dt/ramazancetinkaya/byte-formatter?style=for-the-badge&color=orange)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge&logo=open-source-initiative&logoColor=white)
[![Stars](https://img.shields.io/github/stars/ramazancetinkaya/byte-formatter?style=for-the-badge&color=FAD02E&logo=github)](https://github.com/ramazancetinkaya/byte-formatter/stargazers)
[![Issues](https://img.shields.io/github/issues/ramazancetinkaya/byte-formatter?style=for-the-badge&color=E4405F&logo=github)](https://github.com/ramazancetinkaya/byte-formatter/issues)

**Byte Formatter** is your go-to PHP library for converting bytes into human-readable strings and vice versa. Built with modern PHP 8 features, it’s **fast**, **reliable**, and **developer-friendly**—making your life just that little bit easier when handling data sizes.

<a href="https://github.com/ramazancetinkaya/byte-formatter/issues">Report a Bug</a>
·
<a href="https://github.com/ramazancetinkaya/byte-formatter/pulls">New Pull Request</a>

### ⭐ Show Your Support

If you like this project, give it a ⭐ and share it with your network!

---

## 🚀 Features

- 🧠 **Smart Formatting**: Converts bytes to formats like `10 KiB` or `10 KB`.
- 🔄 **Two-Way Conversion**: Parse size strings like `1.5 MB` into bytes.
- 🎛️ **Customizable Precision**: Fine-tune decimal places in formatted outputs.
- ⚙️ **Binary & Decimal Prefixes**: Switch between 1024 (binary) and 1000 (decimal) systems.
- 💪 **Error Resilient**: Robust validation and descriptive error handling.
- 📦 **Lightweight & Dependency-Free**: No external dependencies—just clean, reliable PHP.

## 📦 Installation

You can install the `ByteFormatter` library using [Composer](https://getcomposer.org/). Run the following command in your terminal:

```bash
composer require ramazancetinkaya/byte-formatter
```

Alternatively, download the source code and include it in your project manually.

### Requirements

- PHP 8.0 or higher.
- No additional dependencies.

## 📖 Usage Examples

### 1. **Basic Formatting**

```php
require 'vendor/autoload.php';

use ramazancetinkaya\ByteFormatter;

$formatter = new ByteFormatter(true, 2); // Binary prefixes, 2 decimal places

echo $formatter->formatBytes(10240); // Output: "10 KiB"
```

### 2. **Parse Human-Readable Strings**

```php
require 'vendor/autoload.php';

use ramazancetinkaya\ByteFormatter;

$formatter = new ByteFormatter();

$bytes = $formatter->parseSize("1.5 MiB");

echo $bytes; // Output: 1572864
```

### 3. **Convert Byte Sizes Between Prefix Systems**

```php
require 'vendor/autoload.php';

use ramazancetinkaya\ByteFormatter;

$formatter = new ByteFormatter();

echo $formatter->convert(10240, false); // Output: "10 KB" (Decimal prefix)
```

## ⚙ Configuration

| Option              | Description                                        | Default |
|---------------------|----------------------------------------------------|---------|
| `useBinaryPrefix`   | Use binary prefixes (1024-based) or decimal (1000) | `true`  |
| `precision`         | Number of decimal places for formatted output      | `2`     |

## 📖 Documentation

### Public Methods

| Method                 | Description                                                                                      |
|------------------------|--------------------------------------------------------------------------------------------------|
| `formatBytes()`        | Formats a byte size into a human-readable string.                                               |
| `parseSize()`          | Parses a human-readable size string into bytes.                                                 |
| `convert()`            | Converts a size between binary and decimal prefix systems or to a specific unit.                |

## 📂 **Project Structure**

```plaintext
src/
├── ByteFormatter.php
composer.json
README.md
```

## 🛡 Security

This library is designed with security in mind. Input validation and error handling are implemented to prevent misuse. For vulnerabilities, please [open an issue](https://github.com/ramazancetinkaya/byte-formatter/issues).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue for any enhancements or bug fixes.

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
