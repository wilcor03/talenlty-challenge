<?php 
namespace App\Providers;

use App\interfaces\Product as ProductI;
use App\Helpers\FileManager as fManag;
use Exception;

require_once dirname(__DIR__)."/config/constants.php";

class ProductProvider implements ProductI{
    protected string $name;
    protected int $quality;
    protected int $sellIn;

    protected $ProductObject;

    public static function of($name, $quality, $sellIn) {                                    
        return new static($name, $quality, $sellIn);
    }

    public function __construct($name, $quality, $sellIn){
        $this->name     = $name;
        $this->quality  = $quality;
        $this->sellIn   = $sellIn;
        $this->loadClassesDynamically(new fManag());
    }

    private function loadClassesDynamically(fManag $fmana){       

        $nameClassesList = $fmana->listPhpFilesInfolder(dirname(__DIR__). DIRECTORY_SEPARATOR .PRODUCT_ROOT_FOLDER, false);        

        foreach($nameClassesList as $className){                    
            $className = "App\\". PRODUCT_ROOT_FOLDER ."\\$className";
            $this->ProductObject = $className::of($this->name, $this->quality, $this->sellIn);            

            if(in_array($this->name, $this->ProductObject->types)){                
                $this->quality = $this->ProductObject->getQuality();
                $this->sellIn  = $this->ProductObject->getSellIn();
                return;
            }
        }

        throw new Exception('Type '. strtoupper($this->name) .', indica un NOMBRE Válido!');        
    }

    public function getQuality():int {
        return $this->quality;
    }

    public function getSellIn():int{
        return $this->sellIn;
    }
}
?>