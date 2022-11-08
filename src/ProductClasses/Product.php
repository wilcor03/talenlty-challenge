<?php
    namespace App\ProductClasses;

    use App\Interfaces\Product as ProductI;
    use App\ProductClasses\_Traits\Calculate;

    class Product implements ProductI{

        use Calculate;

        Const MAX_QUALITY = 50;

        public $types = [
            "normal", 
            "Pisco Peruano",
            "Ticket VIP al concierto de Pick Floid",
            "Tumi de Oro Moche",
            "Café Altocusco"
        ];

        protected string $name;
        protected int $quality;
        protected int $sellIn;

        public static function of($name, $quality, $sellIn) {            
            return new static($name, $quality, $sellIn);
        }

        public function __construct($name, $quality, $sellIn){            
            $this->quality = $quality;        
            $this->sellIn = $sellIn;     
            $this->name = $name;            
            $this->qualityCalculate();
            $this->sellInCalculate();            
        }

        public function getQuality(): int {
            return $this->quality;
        }

        public function getSellIn(): int {
            return $this->sellIn;
        }

        public function setQuality($value) {
            $this->quality = $value;
            return $this;
        }

        public function setSellIn($value) {
            $this->sellIn = $value;
            return $this;
        }

    }
?>
