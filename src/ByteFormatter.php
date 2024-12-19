<?php

namespace ramazancetinkaya;

/**
 * ByteFormatter Class
 * 
 * A professional library for formatting byte values into human-readable strings.
 * 
 * @category Utility
 * @package  ByteFormatter
 * @author   Ramazan Çetinkaya <https://github.com/ramazancetinkaya>
 * @license  MIT License <https://opensource.org/licenses/MIT>
 * @version  1.0.0
 * @link     https://github.com/ramazancetinkaya/byte-formatter
 */
class ByteFormatter
{
    private const DEFAULT_UNITS = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];

    private array $units;
    private int $precision;

    /**
     * Constructor for ByteFormatter.
     *
     * @param int $precision Number of decimal places to format to. Default is 2.
     * @param array $units Custom units for formatting. Defaults to standard units.
     * @throws \InvalidArgumentException if precision is negative or units array is empty.
     */
    public function __construct(int $precision = 2, array $units = self::DEFAULT_UNITS)
    {
        $this->validatePrecision($precision);
        $this->validateUnits($units);

        $this->precision = $precision;
        $this->units = $units;
    }

    /**
     * Formats a given byte value into a human-readable format.
     *
     * @param int|float $bytes The byte value to format.
     * @param bool $binaryPrefix Whether to use binary (1024) or decimal (1000) prefixes. Default is binary.
     * @return string The formatted byte string.
     * @throws \InvalidArgumentException if bytes is not a non-negative numeric value.
     */
    public function formatBytes($bytes, bool $binaryPrefix = true): string
    {
        $this->validateBytes($bytes);

        $factor = $binaryPrefix ? 1024 : 1000;
        $unitIndex = 0;

        while ($bytes >= $factor && $unitIndex < count($this->units) - 1) {
            $bytes /= $factor;
            $unitIndex++;
        }

        return sprintf("%.{$this->precision}f %s", $bytes, $this->units[$unitIndex]);
    }

    /**
     * Converts a formatted string back to bytes.
     *
     * @param string $formattedValue The formatted string (e.g., "1.5 GB").
     * @param bool $binaryPrefix Whether the input uses binary (1024) or decimal (1000) prefixes. Default is binary.
     * @return float The equivalent byte value.
     * @throws \InvalidArgumentException if the formatted value is invalid or contains unknown units.
     */
    public function parseFormattedValue(string $formattedValue, bool $binaryPrefix = true): float
    {
        $factor = $binaryPrefix ? 1024 : 1000;

        if (!preg_match('/^(\d+(\.\d+)?)\s*([a-zA-Z]+)$/', trim($formattedValue), $matches)) {
            throw new \InvalidArgumentException("Invalid formatted value: $formattedValue");
        }

        [$original, $value, $unit] = [$matches[0], (float)$matches[1], strtoupper($matches[3])];
        $unitIndex = array_search($unit, array_map('strtoupper', $this->units), true);

        if ($unitIndex === false) {
            throw new \InvalidArgumentException("Unknown unit '$unit' in value: $formattedValue");
        }

        return $value * ($factor ** $unitIndex);
    }

    /**
     * Validates the precision value.
     *
     * @param int $precision The precision value to validate.
     * @throws \InvalidArgumentException if precision is negative.
     */
    private function validatePrecision(int $precision): void
    {
        if ($precision < 0) {
            throw new \InvalidArgumentException("Precision must be a non-negative integer.");
        }
    }

    /**
     * Validates the units array.
     *
     * @param array $units The units array to validate.
     * @throws \InvalidArgumentException if units array is empty.
     */
    private function validateUnits(array $units): void
    {
        if (empty($units)) {
            throw new \InvalidArgumentException("Units array cannot be empty.");
        }
    }

    /**
     * Validates the bytes value.
     *
     * @param mixed $bytes The bytes value to validate.
     * @throws \InvalidArgumentException if bytes is not a non-negative numeric value.
     */
    private function validateBytes($bytes): void
    {
        if (!is_numeric($bytes) || $bytes < 0) {
            throw new \InvalidArgumentException("Bytes must be a non-negative numeric value.");
        }
    }
}
