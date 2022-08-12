<?php

namespace arrays;

class Arrays implements ArraysInterface
{

    /**
     * Repeat Array Values.
     *
     * @param array $input
     *
     * @return array
     */
    public function repeatArrayValues(array $input): array
    {
       $result = [];
        if ($input) {
            foreach ($input as $item) {
                $result = array_merge($result, array_fill(count($result), $item, $item));
            }
        }

       return $result;
    }

    /**
     * Get Unique Value.
     *
     * @param array $input
     *
     * @return int
     */
    public function getUniqueValue(array $input): int
    {
        $unique = 0;
        if ($input) {
            foreach (array_unique($input) as $item) {
                // Check if $item is repeated.
                $matches = array_filter($input, function ($value) use ($item) {
                    return $item === $value;
                });

                $match_numbers = count($matches);

                // Set $unique.
                if ($match_numbers === 1) {
                    if ($unique === 0 || $unique > $item) {
                        $unique = $item;
                    }
                }
            }
        }

        return $unique;
    }

    /**
     * Group By Tag.
     *
     * @param array $input
     *
     * @return array
     */
    public function groupByTag(array $input): array
    {
        $result = [];
        if ($input) {
            foreach ($input as $item) {
                foreach ($item['tags'] as $tag) {
                    $result[$tag][] = $item['name'];
                }
            }
        }
        // Sort values inside the tag.
        foreach ($result as &$tag) {
            sort($tag);
        }
        // Sort by key.
        ksort($result);

        return $result;
    }
}