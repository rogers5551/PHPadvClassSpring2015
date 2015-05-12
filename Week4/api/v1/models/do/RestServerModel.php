<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RestAPIModel
 *
 * @author GFORTI
 */

namespace API\models\services;


class RestServerModel extends BaseModel {
   
    
    private $verb;
    private $resource;
    private $id;
    private $requestData;
    private $endpoint;
            
    
    function getVerb() {
        return $this->verb;
    }

    function getResource() {
        return $this->resource;
    }

    function getId() {
        return $this->id;
    }

    function setVerb($verb) {
        $this->verb = $verb;
    }

    function setResource($resource) {
        $this->resource = $resource;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getRequestData() {
        return $this->requestData;
    }

    function setRequestData($requestData) {
        $this->requestData = $requestData;
    }

    function getEndpoint() {
        return $this->endpoint;
    }

    function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;
    }


}
