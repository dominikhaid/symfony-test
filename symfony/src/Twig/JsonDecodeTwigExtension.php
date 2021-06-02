<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class JsonDecodeTwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        $returnArray = [];
        $methods = [
            'json_decode',
        ];

        foreach ($methods as $methodName) {
            $returnArray[$methodName] = new TwigFilter('json_decode', [$this, $methodName]);
        }

        return $returnArray;
    }

    public function json_decode($json, $assoc = false)
    {
        $decoded = json_decode($json, $assoc);

        return $decoded;
    }
}
