<?php

declare(strict_types=1);

namespace TTBooking\CurrencyExchange;

final class StringUtil
{
    /**
     * Transforms an XML string to an element.
     *
     * @throws \RuntimeException
     */
    public static function xmlToElement(string $string): \SimpleXMLElement
    {
        $internalErrors = libxml_use_internal_errors(true);

        try {
            // Allow XML to be retrieved even if there is no response body
            $xml = new \SimpleXMLElement($string ?: '<root />', LIBXML_NONET);

            libxml_use_internal_errors($internalErrors);
        } catch (\Exception $e) {
            libxml_use_internal_errors($internalErrors);

            throw new \RuntimeException('Unable to parse XML data: '.$e->getMessage());
        }

        return $xml;
    }

    /**
     * Transforms a JSON string to an array.
     *
     * @throws \RuntimeException
     */
    public static function jsonToArray(string $string): array
    {
        static $jsonErrors = [
            JSON_ERROR_DEPTH => 'JSON_ERROR_DEPTH - Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'JSON_ERROR_STATE_MISMATCH - Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR => 'JSON_ERROR_CTRL_CHAR - Unexpected control character found',
            JSON_ERROR_SYNTAX => 'JSON_ERROR_SYNTAX - Syntax error, malformed JSON',
            JSON_ERROR_UTF8 => 'JSON_ERROR_UTF8 - Malformed UTF-8 characters, possibly incorrectly encoded',
        ];

        $data = json_decode($string, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $last = json_last_error();

            throw new \RuntimeException('Unable to parse JSON data: '.($jsonErrors[$last] ?? 'Unknown error'));
        }

        return $data;
    }
}
