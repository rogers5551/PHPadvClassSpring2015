<?php
/**
 * Description of EmailService
 *
 * @author GFORTI
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class EmailService implements IService {
    
    protected $emailDAO;
    protected $emailTypeService;
    protected $validator;
    protected $model;
                function getValidator() {
        return $this->validator;
    }

    function setValidator($validator) {
        $this->validator = $validator;
    }                
     
    function getEmailDAO() {
        return $this->emailDAO;
    }

    function setEmailDAO(IDAO $DAO) {
        $this->emailDAO = $DAO;
    }
    
    function getEmailTypeService() {
        return $this->emailTypeService;
    }

    function setEmailTypeService(IService $service) {
        $this->emailTypeService = $service;
    }
    
    
    function getModel() {
        return $this->model;
    }

    function setModel(IModel $model) {
        $this->model = $model;
    }

        public function __construct( IDAO $emailDAO, IService $emailTypeService, IService $validator, IModel $model  ) {
        $this->setEmailDAO($emailDAO);
        $this->setEmailTypeService($emailTypeService);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    
    public function getAllEmailTypes() {       
        return $this->getEmailTypeService()->getAllRows();   
        
    }
    
     public function getAllEmails() {       
        return $this->getEmailDAO()->getAllRows();   
        
    }
    
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getEmailDAO()->create($model);
        }
        return false;
    }
    
    
    public function validate( IModel $model ) {
        $errors = array();
        
        if ( !$this->getEmailTypeService()->idExist($model->getEmailtypeid()) ) {
            $errors[] = 'Email Type is invalid';
        }
       
        if ( !$this->getValidator()->emailIsValid($model->getEmail()) ) {
            $errors[] = 'Email is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Email active is invalid';
        }
       
        
        return $errors;
    }
    
    
    public function read($id) {
        return $this->getEmailDAO()->read($id);
    }
    
    public function delete($id) {
        return $this->getEmailDAO()->delete($id);
    }
    
    
     public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getEmailDAO()->update($model);
        }
        return false;
    }
    
    
     public function getNewEmailModel() {
        return clone $this->getModel();
    }
    
    
}
