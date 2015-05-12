<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page404Controller
 *
 * @author GFORTI
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;


class Page404Controller extends BaseController implements IController {
    
    public function execute(IService $scope) {
        $this->data['error'] = $scope->util->getUrlParam('error');
        $scope->view = $this->data;
        return $this->view('page404',$scope);
    }
}
