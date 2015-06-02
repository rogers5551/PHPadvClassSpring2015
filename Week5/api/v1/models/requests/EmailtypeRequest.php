<?php

/**
 * Description of EmailtypeController
 *
 * @author User
 */

namespace API\models\services;

use API\models\interfaces\IRequest;
use API\models\interfaces\IService;
use API\models\interfaces\IModel;


class EmailtypeRequest implements IRequest {
    //put your code here
    
    protected $service;
            
    public function __construct( IService $service) {
        $this->service = $service;
    }
    
    public function POST( IModel $model ) { 
        $emailModel = $this->service->getNewEmailTypeModel();
        $emailModel->map($model->getRequestData());
        if ( $this->service->create($emailModel) ) {
            throw new ContentCreatedException('Created');           
        }
        $errors = $this->service->validate($emailModel);
        
        if ( count($errors) > 0 ) {
            throw new ValidationException($errors, 'New Email Type Not Created');
        }
        throw new ConflictRequestException('New Email Type Not Created');
    }
    
    public function GET( IModel $model ) {
        $id = intval($model->getId());
        
        if ( $id > 0 ) { 
            if ( $this->service->idExist($model->getId()) ) {
                return $this->service->read($model->getId())->getAllPropteries();
            } else {
                throw new NoContentRequestException($id . ' ID does not exist');
            }
        }
        $data = $this->service->getAllRows();
        $values = array();
        
        foreach ($data as $value) {
            $values[] = $value->getAllPropteries();
        }
        
        return $values;
    }
    
    public function PUT( IModel $model ) {
        $id = intval($model->getId());
        $emailTypeModel = $this->service->getNewEmailTypeModel();
        $emailTypeModel->map($model->getRequestData());
        $emailTypeModel->setEmailtypeid($id);
        
        if ( !$this->service->idExist($id) ) {
            throw new NoContentRequestException($id . ' ID does not exist');
        }
        
        if ( $this->service->update($emailTypeModel) ) {
            throw new ContentCreatedException('Created');           
        }
        throw new ConflictRequestException('New Email Type Not Updated for id ' . $id);
    }
    
    public function DELETE( IModel $model ) {
        $id = intval($model->getId());        
        if ( $this->service->delete($id) ) {
            return null;          
        }
        throw new ConflictRequestException($id . ' ID Email Type Not Deleted');
    }
}
