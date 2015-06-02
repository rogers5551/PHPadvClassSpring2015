<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author GForti
 */

namespace API\models\interfaces;

interface ILogging {
        
    public function log($data);
    public function logDebug($data);
    public function logException($data);
    public function logError($data);
 
}
