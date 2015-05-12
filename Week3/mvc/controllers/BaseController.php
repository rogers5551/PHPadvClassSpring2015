<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author User
 */

namespace APP\controller;

use App\models\interfaces\IService;

class BaseController {
    
    protected $data = array();
    
    protected function view($page, IService $scope) {

        $folder = "mvc".DIRECTORY_SEPARATOR."views";
        $file = $folder.DIRECTORY_SEPARATOR.$page.'.php';
        if ( is_dir($folder) &&  file_exists( $file ) ) {
            include_once $file; 
            return true;
        } 
        
        return false;
    }
    
}
