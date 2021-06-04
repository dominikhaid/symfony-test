<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Generates a source tag to use inside an responsive picture.
 */
class ResponsiveImageExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('responsive_image', [$this, 'responsiveImageSourceFilter'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param string $imageUrl
     * @param array  $widths
     *
     * @return string
     */
    public function responsiveImageSourceFilter($imageUrl, $widths = [128, 256, 384, 640, 750])
    {
        $srcSets = [];
        $count = 1;
        foreach ($widths as $width) {
            if ($count !== count($widths)) {
                $resizedImageUrl = $this->getImagineUrl($imageUrl, $width, $widths[$count]);
                $srcSets[] = $resizedImageUrl;
                ++$count;
            } else {
                $resizedImageUrl = $this->getImagineUrl($imageUrl, $width, '2000');
                $srcSets[] = $resizedImageUrl;
                ++$count;
            }
        }

        return implode(' ', $srcSets);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'responsive_image';
    }

    /**
     * @param string $imageUrl
     * @param int    $width
     * @param mixed  $widths
     * @param mixed  $count
     * @param mixed  $max
     *
     * @return mixed
     */
    private function getImagineUrl($imageUrl, $width, $max)
    {
        $newImageUrl = preg_replace('/(.*)?(\.\w\w\w?\w)/', "$1_{$width}_75$2", $imageUrl);

        return "<source srcset='".$newImageUrl."' media='(max-width: ".$max."px)' />";
    }
}
