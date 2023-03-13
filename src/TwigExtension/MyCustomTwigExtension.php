<?php

namespace App\TwigExtension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustomTwigExtension extends AbstractExtension
{
public function getFilters()
{
    return [
        new twigFilter('defaultImage',[$this,'defaultImage'])
    ];
}

public function defaultImage(string $path ):string{
    if(strlen(trim($path))==0){
        return 'img.png';
    }
    return $path;
}
}