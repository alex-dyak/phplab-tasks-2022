<?php

namespace strings;

class Strings implements StringsInterface
{

    /**
     * Snake Case To Camel Case.
     *
     * @param string $input
     *
     * @return string
     */
    public function snakeCaseToCamelCase(string $input): string
    {
        return lcfirst(str_replace('_', '', ucwords($input, "_")));
    }

    /**
     * Mirror Multibyte String.
     *
     * @param string $input
     *
     * @return string
     */
    public function mirrorMultibyteString(string $input): string
    {
        $words_arr = explode(' ', $input);
        $reverse = '';
        $counter = 1;
        foreach ($words_arr as $item) {
            for ($i = mb_strlen($item); $i >= 0; $i--) {
                $reverse .= mb_substr($item, $i, 1);
            }
            if ($counter < count ($words_arr)) {
                $reverse .= ' ';
            }
            $counter++;
        }

        return $reverse;
    }

    /**
     * Get Brand Name.
     *
     * @param string $noun
     *
     * @return string
     */
    public function getBrandName(string $noun): string
    {
        $first_char = substr($noun, 0, 1);
        $last_char  = substr($noun, -1, 1);

        if ($first_char !== $last_char) {
            return 'The ' . ucfirst($noun);
        } else {
            return ucfirst($noun) . substr($noun, 1);
        }
    }
}