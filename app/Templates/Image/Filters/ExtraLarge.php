<?php

namespace App\Templates\Image\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class ExtraLarge implements FilterInterface
{
    public function applyFilter(Image $image): Image
    {
        return $image->fit(960, 720);
    }
}
