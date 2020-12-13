<?php


namespace App\Service;


class Slugify
{
    function generate(string $input): string
    {
        $slug = trim(strtolower($input));
        $slug = str_replace(' ', '-', $slug);

        return  $slug;
    }

}
