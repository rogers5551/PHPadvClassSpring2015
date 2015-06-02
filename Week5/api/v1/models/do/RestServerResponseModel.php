<?php

/**
 * Description of RestServerResponseModel
 *
 * @author User
 */

namespace API\models\services;


class RestServerResponseModel extends BaseModel {
   
    private $status_code;
    private $status_message;
    private $message;
    private $errors;
    private $data;
    
            
    function getStatus_code() {
        return $this->status_code;
    }

    function getStatus_message() {
        return $this->status_message;
    }
    
    function getMessage() {
        return $this->message;
    }

    function getErrors() {
        return $this->errors;
    }
    
    function getData() {
        return $this->data;
    }

    function setStatus_code($status_code) {
        $this->status_code = $status_code;
    }

    function setStatus_message($status_message) {
        $this->status_message = $status_message;
    }
    
    function setMessage($message) {
        $this->message = $message;
    }
    
    function setErrors($errors) {
        $this->errors = $errors;
    }
    
    function setData($data) {
        $this->data = $data;
    }
    
}
