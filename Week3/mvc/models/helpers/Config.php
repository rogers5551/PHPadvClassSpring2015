<?php
/**
 * Description of Config
 *
 * @author User
 */

namespace App\models\services;

use App\models\interfaces\IService;

class Config implements IService {
    
    private $data = false;
    
    public function __construct($iniFile) {
        $this->setData($iniFile);
    }
    
    private function getData() {
        return $this->data;
    }

    private function setData($iniFile) {
        if ( !empty($iniFile) && file_exists($iniFile) ) {
            $this->data = parse_ini_file($iniFile, true);
        }
    }

    public function getConfigData($section = null, $name = null) {
               
        if( NULL != $section && is_array($this->getData()) && array_key_exists($section, $this->getData()) ) {
            
            if( NULL !== $name && is_array($this->getData()[$section]) && array_key_exists($name, $this->getData()[$section]) ) {                
                return $this->getData()[$section][$name];
            } else {
                return $this->getData()[$section];
            }
            
        } else {           
            return $this->getData();
        }
    }
    
}
