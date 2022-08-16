<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;

class FilmixParserStrategy implements ParserInterface
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
        // Get charset for encoding.
        $charset = '';
        if (preg_match_all('/charset="(.*)"/', $siteContent, $matches)) {
            $charset = $matches[1][0];
        }
        // Set Movie title.
        if (preg_match_all('|<\s*h1.*>(.*)</\s*h|Ui', $siteContent, $matches_title)) {
            if ($charset) {
                $title = strip_tags(mb_convert_encoding($matches_title[0][0], "utf-8", $charset));
            } else {
                $title = strip_tags($matches_title[0][0]);
            }
            $this->movie->setTitle($title);
        }
        // Set Movie description.
        if (preg_match_all('/<div\s* class=\"full-story\">(.*)<\/div><div/', $siteContent, $matches_desc)) {
            if ($charset) {
                $description = mb_convert_encoding($matches_desc[0][0], "utf-8", $charset);
            } else {
                $description = $matches_desc[0][0];
            }
            $this->movie->setDescription($description);
        }
        // Set Movie poster.
        if (preg_match_all('/src="(.*[a-z0-9].[a-z])"\s*class="poster poster-tooltip"/', $siteContent, $matches_poster)) {
            $poster = $matches_poster[1][0];
            $this->movie->setPoster($poster);
        }

        return $this->movie;
    }
}
