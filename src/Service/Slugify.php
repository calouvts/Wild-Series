<?php


namespace App\Service;


class Slugify
{
    function generate(string $input): string
    {

        $slug = strtolower($input);
        $slug = trim($slug);
        $slug = str_replace(['!', '?', '\'', '.', ';', ',', '.'], ' ', $slug);
        $slug = preg_replace('/\-+/', '-', $slug);
        $slug = str_replace(' ', '-', $slug);
        $slug = iconv("UTF-8", "ASCII//TRANSLIT", $slug);

        return  $slug;


    }

}
