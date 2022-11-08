<?php

    namespace App\ProductClasses\_Traits;

    Trait Calculate{
        private function qualityCalculate(){           

            $upOrDownQualityTimes  = ( $this->sellIn <= 0 ) ? 2 : 1; 

            switch($this->name){
                case 'normal':                    
                    //$upOrDownQualityTimes  = ( $this->sellIn <= 0 ) ? 2 : 1;                    
                    $this->quality = ( ( $this->quality - $upOrDownQualityTimes ) >= 0 ) ? $this->quality - $upOrDownQualityTimes : $this->quality;
                   break;

                case "Pisco Peruano":
                    //$upOrDownQualityTimes = ($this->sellIn <= 0) ? 2 : 1;    
                    $this->quality = ( ($this->quality + $upOrDownQualityTimes) >= Self::MAX_QUALITY) ? Self::MAX_QUALITY : $this->quality + $upOrDownQualityTimes;                    
                    break;       

                case "Ticket VIP al concierto de Pick Floid":                           
                    
                    switch( true ){
                        Case ($this->sellIn <= 0):                            
                                $this->quality = 0;
                                return;
                            break;

                        Case ($this->sellIn >= 1 && $this->sellIn <= 5):
                            $upOrDownQualityTimes = 3;                        
                            break;

                        Case ($this->sellIn >= 6 && $this->sellIn <= 10):
                            $upOrDownQualityTimes = 2;
                            break;

                        default:
                            $upOrDownQualityTimes = 1;
                            break;
                    }
                    
                    $this->quality = (($this->quality + $upOrDownQualityTimes) >= Self::MAX_QUALITY) ? Self::MAX_QUALITY : $this->quality + $upOrDownQualityTimes;                    
                    
                    break;

                case "Café Altocusco":                                                           
                    $upOrDownQualityTimes *= 2;
                    
                    $this->quality = ( ( $this->quality - $upOrDownQualityTimes ) >= 0 ) 
                                    ? $this->quality - $upOrDownQualityTimes 
                                    : $this->quality;
                    break;

            }
        }  
        

        private function sellInCalculate(){
            $sellIn = $this->name != "Tumi de Oro Moche" ? $this->sellIn -1 : $this->sellIn;
            $this->setSellIn($sellIn);
        }
    }

?>