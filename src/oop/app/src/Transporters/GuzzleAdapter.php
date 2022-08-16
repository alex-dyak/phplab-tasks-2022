<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;

class GuzzleAdapter implements TransportInterface
{
    /**
     * @inheritDoc
     */
    public function getContent(string $url): string
    {
        // Get page content.
        $client = new Client();

        $res = $client->request('GET', $url);

        return $res->getBody();
    }
}