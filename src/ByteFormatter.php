<?php

/**
 * Class ByteFormatter
 *
 * Formats bytes into a human-readable format and vice versa.
 * 
 * @category  Utility
 * @package   ByteFormatter 
 * @author    Ramazan Çetinkaya <ramazancetinkayadev@outlook.com>
 * @license   MIT License <https://opensource.org/licenses/MIT>
 * @version   1.0.0
 * @link      https://github.com/ramazancetinkaya/byte-formatter
 */

namespace ramazancetinkaya;

class ByteFormatter {
    /**
     * Configuration options.
     * @var array
     */
    private $config;

    /**
     * ByteFormatter constructor.
     * @param array $config Configuration options for formatting.
     */
    public function __construct(array $config = []) {
        // Set default configuration options
        $defaultConfig = [
            'decimalPlaces' => 2,
            'units' => ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        ];

        // Merge provided configuration with defaults
        $this->config = array_merge($defaultConfig, $config);
    }

    /**
     * Formats bytes into a human-readable format.
     * @param int $bytes The number of bytes to format.
     * @return string Formatted byte size.
     */
    public function format($bytes) {
        if (!is_numeric($bytes) || $bytes < 0) {
            // Handle invalid input
            throw new InvalidArgumentException('Invalid input. Please provide a non-negative numeric value.');
        }

        $precision = $this->config['decimalPlaces'];
        $units = $this->config['units'];
        $bytes = max($bytes, 0);
        $power = floor(($bytes ? log($bytes) : 0) / log(1024));
        $formatted = round($bytes / pow(1024, $power), $precision);

        if (!isset($units[$power])) {
            // Handle edge cases for extremely large values
            $formatted = ($power === 0) ? $bytes : '∞';
            $power = count($units) - 1;
        }

        return $formatted . ' ' . $units[$power];
    }

    /**
     * Converts a human-readable format back to bytes.
     * @param string $formattedSize The human-readable size to convert (e.g., '10 MB').
     * @return int Converted size in bytes.
     */
    public function convertToBytes($formattedSize) {
        $units = $this->config['units'];
        $sizeParts = explode(' ', $formattedSize);
        if (count($sizeParts) !== 2 || !is_numeric($sizeParts[0]) || !in_array($sizeParts[1], $units)) {
            // Handle invalid input format
            throw new InvalidArgumentException('Invalid input format. Please provide a valid human-readable size (e.g., "10 MB").');
        }

        $power = array_search($sizeParts[1], $units);
        $bytes = $sizeParts[0] * pow(1024, $power);

        return (int)$bytes;
    }
}
