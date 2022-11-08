<?php

namespace App;

use App\Providers\ProductProvider;

class GildedRose
{
    protected $productProvider;

    public string $name;
    public int $quality;
    public int $sellIn;
    
    public static function of($name, $quality, $sellIn) {
        $productProvider = ProductProvider::of($name, $quality, $sellIn);
        return new static($name, $quality, $sellIn, $productProvider);
    }

    public function __construct(string $name, int $quality, int $sellIn, $productProvider){             
        $this->productProvider  = $productProvider;
        $this->name             = $name;
        $this->quality          = $quality;
        $this->sellIn           = $sellIn;
    }


    public function tick() {
        $this->quality  = $this->productProvider->getQuality();
        $this->sellIn   = $this->productProvider->getSellIn();

        /*if ($this->name != 'Pisco Peruano' and $this->name != 'Ticket VIP al concierto de Pick Floid') {
            if ($this->quality > 0) {
                if ($this->name != 'Tumi de Oro Moche') {
                    $this->quality = $this->quality - 1;
                }
            }
        } else {
            if ($this->quality < 50) {
                $this->quality = $this->quality + 1;

                if ($this->name == 'Ticket VIP al concierto de Pick Floid') {
                    if ($this->sellIn < 11) {
                        if ($this->quality < 50) {
                            $this->quality = $this->quality + 1;
                        }
                    }
                    if ($this->sellIn < 6) {
                        if ($this->quality < 50) {
                            $this->quality = $this->quality + 1;
                        }
                    }
                }
            }
        }

        if ($this->name != 'Tumi de Oro Moche') {
            $this->sellIn = $this->sellIn - 1;
        }

        if ($this->sellIn < 0) {
            if ($this->name != 'Pisco Peruano') {
                if ($this->name != 'Ticket VIP al concierto de Pick Floid') {
                    if ($this->quality > 0) {
                        if ($this->name != 'Tumi de Oro Moche') {
                            $this->quality = $this->quality - 1;
                        }
                    }
                } else {
                    $this->quality = $this->quality - $this->quality;
                }
            } else {
                if ($this->quality < 50) {
                    $this->quality = $this->quality + 1;
                }
            }
        }*/
    }
}
