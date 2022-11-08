<?php
    namespace App\Interfaces;

    interface Product{
        public function __construct($name, $quality, $sellIn);
        public function getQuality(): int;
        public function getSellIn(): int;
    }
?>