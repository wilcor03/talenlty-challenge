<?php
namespace App\Helpers;

class FileManager{

    public function listPhpFilesInfolder(string $path, bool $includeExtension){        

        if( !file_exists($path) ){ return []; }
        
        if ( $handler = opendir( $path ) ) {
            
            while (false !== ($file = readdir($handler))) {
                if (strpos($file, ".php") != false){

                    if(!$includeExtension){
                        $file = str_replace(".php", "", $file);
                    } 
                    $items[] = $file;
                }
            }            
            closedir($handler);            
        }

        return $items;
    }
}