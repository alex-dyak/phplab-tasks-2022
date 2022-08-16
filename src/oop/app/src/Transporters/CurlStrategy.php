<?php

namespace src\oop\app\src\Transporters;

class CurlStrategy implements TransportInterface
{

    /**
     * @inheritDoc
     */
    public function getContent(string $url): string
    {
        // Get page content.
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $content = curl_exec($ch);

        curl_close($ch);

        return $content;
    }
}