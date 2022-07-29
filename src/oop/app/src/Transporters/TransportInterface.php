<?php
/**
 * Create two Classes - GuzzleAdapter and CurlStrategy.
 * Implement the TransportInterface and following methods:
 * getContent() - should return site page content.
 *
 * For Class GuzzleAdapter use GuzzleHttp Client for getting the page content.
 * Note: Use next namespace for GuzzleAdapter Class - "namespace src\oop\app\src\Transporters;" (Like in this Interface)
 * Note: About GuzzleHttp Client you can read here:
 * https://docs.guzzlephp.org/en/stable/
 * Attention: Think about why this Transporter might have a Adapter word in name!!!
 *
 * For Class CurlStrategy use simple СURL PHP Library for getting the page content.
 * Note: Use next namespace for CurlStrategy Class - "namespace src\oop\app\src\Transporters;" (Like in this Interface)
 * Note: About СURL PHP you can read here:
 * https://www.php.net/manual/ru/book.curl.php
 * Attention: Think about why this Transporter might have a Strategy word in name!!!
 */

namespace src\oop\app\src\Transporters;

interface TransportInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function getContent(string $url): string;
}