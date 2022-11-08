<?php
namespace App\ProductClasses;

use App\ProductClasses\Product;

class CoffeProduct extends Product{

    public $types = ["Café Altocusco"];

    public static function of($name, $quality, $sellIn) {            
        return new static($name, $quality, $sellIn);
    }

    public function __construct($name, $quality, $sellIn){            
        parent::__construct($name, $quality, $sellIn);                  
    }

    private function qualityCalculate(){
        $upOrDownQualityTimes  = ( $this->sellIn <= 0 ) ? 4 : 2;
                    
        $this->quality = ( ( $this->quality - $upOrDownQualityTimes ) >= 0 ) 
                        ? $this->quality - $upOrDownQualityTimes 
                        : $this->quality;
    }
}
