<?php

declare(strict_types=1);

namespace ramazancetinkaya;

use InvalidArgumentException;
use Exception;

/**
 * ByteFormatter Class
 * 
 * A modern PHP library for formatting and parsing byte values with precision and flexibility.
 * 
 * @category Utility
 * @package  ByteFormatter
 * @author   Ramazan Çetinkaya
 * @license  MIT License <https://opensource.org/licenses/MIT>
 * @version  1.0.0
 * @link     https://github.com/ramazancetinkaya/byte-formatter
 */
class ByteFormatter
{
    /**
     * @var bool $useBinaryPrefix
     *
     * If true, uses binary prefixes (1024). If false, uses decimal
     * prefixes (1000).
     */
    private bool $useBinaryPrefix;

    /**
     * @var int $precision
     *
     * Determines the precision (number of decimals) for
     * the formatted output.
     */
    private int $precision;

    /**
     * @var array $binaryUnits
     *
     * An array of binary prefixes for human-readable byte formatting.
     */
    private array $binaryUnits = [
        'B',
        'KiB',
        'MiB',
        'GiB',
        'TiB',
        'PiB',
        'EiB',
        'ZiB',
        'YiB'
    ];

    /**
     * @var array $decimalUnits
     *
     * An array of decimal prefixes for human-readable byte formatting.
     */
    private array $decimalUnits = [
        'B',
        'KB',
        'MB',
        'GB',
        'TB',
        'PB',
        'EB',
        'ZB',
        'YB'
    ];

    /**
     * Constructor
     *
     * @param bool $useBinaryPrefix Set to true for binary (1024) prefixes,
     *                              or false for decimal (1000) prefixes.
     * @param int  $precision       The number of decimals to keep in
     *                              the formatted output.
     */
    public function __construct(bool $useBinaryPrefix = true, int $precision = 2)
    {
        $this->useBinaryPrefix = $useBinaryPrefix;
        $this->precision       = $precision;
    }

    /**
     * Set whether to use binary or decimal prefixes.
     *
     * @param bool $useBinaryPrefix
     * @return void
     */
    public function setUseBinaryPrefix(bool $useBinaryPrefix): void
    {
        $this->useBinaryPrefix = $useBinaryPrefix;
    }

    /**
     * Get whether the instance is using binary or decimal prefixes.
     *
     * @return bool
     */
    public function getUseBinaryPrefix(): bool
    {
        return $this->useBinaryPrefix;
    }

    /**
     * Set the precision (number of decimals) to show in formatted results.
     *
     * @param int $precision
     * @return void
     */
    public function setPrecision(int $precision): void
    {
        if ($precision < 0) {
            throw new InvalidArgumentException('Precision cannot be negative.');
        }

        $this->precision = $precision;
    }

    /**
     * Get the current precision (number of decimals) used in formatting.
     *
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }

    /**
     * Format the given size in bytes to a human-readable string.
     *
     * @param int $bytes The size in bytes that needs to be formatted.
     *
     * @return string A human-readable string representing the size,
     *                e.g., "10 MB".
     *
     * @throws InvalidArgumentException if $bytes is negative.
     */
    public function formatBytes(int $bytes): string
    {
        if ($bytes < 0) {
            throw new InvalidArgumentException('Byte size cannot be negative.');
        }

        $units = $this->useBinaryPrefix ? $this->binaryUnits : $this->decimalUnits;
        $base  = $this->useBinaryPrefix ? 1024 : 1000;

        if ($bytes === 0) {
            return '0 ' . $units[0];
        }

        $exponent = (int) floor(log($bytes, $base));
        $exponent = min($exponent, count($units) - 1);

        $formattedValue = $bytes / ($base ** $exponent);
        return round($formattedValue, $this->precision) . ' ' . $units[$exponent];
    }

    /**
     * Parse a human-readable size string into bytes.
     *
     * For example:
     *  - "1 KB"  -> 1000 (if using decimal prefixes)
     *  - "1 KiB" -> 1024 (if using binary prefixes)
     *  - "1 MB"  -> 1000000 (if decimal)
     *  - "1 MiB" -> 1048576 (if binary)
     *
     * @param string $sizeString A string representing the size, e.g., "1 MB" or "1 MiB".
     *
     * @return int The size in bytes.
     *
     * @throws InvalidArgumentException if $sizeString is malformed or contains invalid units.
     */
    public function parseSize(string $sizeString): int
    {
        $sizeString = trim($sizeString);

        if (empty($sizeString)) {
            throw new InvalidArgumentException('Size string cannot be empty.');
        }

        // Split the numeric part and the unit part
        // This regex handles cases like "1.5 KB", "1 KB", "1024 B", etc.
        if (!preg_match('/^([0-9]*\.?[0-9]+)\s*([A-Za-z]+)$/', $sizeString, $matches)) {
            throw new InvalidArgumentException('Invalid size string format. Example: "1 MB".');
        }

        $value = (float) $matches[1];
        $unit  = strtoupper($matches[2]);

        // Determine if the string is using binary or decimal units based on user config
        $units = $this->useBinaryPrefix ? array_map('strtoupper', $this->binaryUnits)
                                        : array_map('strtoupper', $this->decimalUnits);

        $index = array_search($unit, $units, true);

        if ($index === false) {
            throw new InvalidArgumentException("Invalid unit '{$matches[2]}'. Supported units: " . implode(', ', $units));
        }

        $base = $this->useBinaryPrefix ? 1024 : 1000;

        // Convert the value to bytes
        $bytes = $value * ($base ** $index);

        // Ensure we return an integer value
        return (int) round($bytes);
    }

    /**
     * Converts an input size in bytes from one prefix system to another,
     * or from one unit to a specific desired unit. This is an optional
     * function that demonstrates the library’s flexibility.
     *
     * @param int    $bytes       The size in bytes.
     * @param bool   $toBinary    Whether to convert to binary (true) or decimal (false) prefix system.
     * @param string $forceUnit   If provided, forces a specific unit. Example: "MB" or "MiB".
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function convert(int $bytes, bool $toBinary, string $forceUnit = ''): string
    {
        if ($bytes < 0) {
            throw new InvalidArgumentException('Byte size cannot be negative.');
        }

        $units = $toBinary ? $this->binaryUnits : $this->decimalUnits;
        $base  = $toBinary ? 1024 : 1000;

        // If a specific unit is not forced, just format as usual
        if (empty($forceUnit)) {
            $exponent = (int) floor(log($bytes, $base));
            $exponent = min($exponent, count($units) - 1);

            $formattedValue = $bytes / ($base ** $exponent);
            return round($formattedValue, $this->precision) . ' ' . $units[$exponent];
        }

        // If a specific unit is forced
        $upperForceUnit = strtoupper($forceUnit);
        $upperUnits     = array_map('strtoupper', $units);
        $unitIndex      = array_search($upperForceUnit, $upperUnits, true);

        if ($unitIndex === false) {
            throw new InvalidArgumentException("Invalid forced unit '$forceUnit'. Allowed units: " . implode(', ', $units));
        }

        $convertedValue = $bytes / ($base ** $unitIndex);
        return round($convertedValue, $this->precision) . ' ' . $units[$unitIndex];
    }
}
