<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Scope
 *
 * @author GForti
 */
namespace App\models\services;

use App\models\interfaces\IService;

class Scope implements IService {
   private $data = array();

   public function __construct(){
    $this->data = array();
    }

   public function __get($varName){

      if (!array_key_exists($varName,$this->data)){
          //this attribute is not defined!
          throw new ScopeVariableNotFoundException('Scope variable '. $varName .' not found or set.');
      } else { 
          return $this->data[$varName];
      }

   }

   public function __set($varName,$value){
      $this->data[$varName] = $value;
   }
}
