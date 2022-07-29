<?php
/**
 * Create Class - Movie.
 * Implement the MovieInterface and following methods:
 * getTitle(), setTitle(), getPoster(), setPoster(), getDescription(), setDescription()
 * for record and read Movie data.
 *
 * Note: Dont forget to create properties for storing Movie data.
 * Note: Use next namespace for Movie Class - "namespace src\oop\app\src\Models;" (Like in this Interface)
 *
 * Note: You need to inject this Class somewhere in the code to get Movie object with film data.
 * Think about where and how to do it better!!!
 */

namespace src\oop\app\src\Models;

interface MovieInterface
{
    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return string
     */
    public function getPoster(): string;

    /**
     * @param string $poster
     */
    public function setPoster(string $poster): void;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;
}