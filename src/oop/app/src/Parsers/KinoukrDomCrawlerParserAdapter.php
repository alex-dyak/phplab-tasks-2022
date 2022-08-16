<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;
use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{

    /**
     * Movie.
     *
     * @var Movie
     */
    private Movie $movie;

    public function __construct()
    {
        $this->movie = new Movie();
    }

    /**
     * @inheritDoc
     */
    public function parseContent(string $siteContent)
    {
        $crawler = new Crawler($siteContent);
        // Set Movie title.
        $title = $crawler->filter('h1')->text();
        $this->movie->setTitle($title);
        // Set Movie description.
        $description = $crawler->filter('div.fdesc')->text();
        $this->movie->setDescription($description);
        // Set Movie poster.
        $poster = $crawler->filter('div.fposter > a')->eq(0)->attr('href');
        $this->movie->setPoster($poster);

        return $this->movie;
    }
}
