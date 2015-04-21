<?php

interface IDAO 
{
    public function getById($id);
    public function delete($id); 
    public function save(IModel $model);
    public function getAllRows();
}