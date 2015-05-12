<?php

/**
 * Description of TestController
 *
 * @author GFORTI
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;



class TestController extends BaseController implements IController {
    
    protected $service;
    
    public function __construct( IService $TestService ) {                
        $this->service = $TestService;     
        
    }
    
      public function execute(IService $scope) {
          
          if ( $scope->util->isPostRequest() ) {
               $this->data['email'] = filter_input(INPUT_POST, 'email');
               
               $this->data['emailvalid'] = $this->service->validateForm($this->data['email']);
               
          }
          
          $this->data['test1'] = 'hello';
          $this->data['test2'] = 'world';
          
          $scope->view = $this->data;
          $page = 'test';
          return $this->view($page, $scope);          
      }
    
}
