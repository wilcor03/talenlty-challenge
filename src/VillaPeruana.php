<?php

namespace App;

use App\Providers\ProductProvider;
use App\Interfaces\Product as ProductI;

class VillaPeruana
{    
    protected $productProvider;
    
    public string $name;
    public int $quality;
    public int $sellIn;

    public static function of($name, $quality, $sellIn) {
        $productProvider = ProductProvider::of($name, $quality, $sellIn);
        return new static($name, $quality, $sellIn, $productProvider);
    }
    
    public function __construct(string $name, int $quality, int $sellIn, ProductI $productProvider){             
        $this->productProvider  = $productProvider;
        $this->name             = $name;
        $this->quality          = $quality;
        $this->sellIn           = $sellIn;
    }

    public function tick(){
        $this->quality  = $this->productProvider->getQuality();
        $this->sellIn   = $this->productProvider->getSellIn();
    }
}
