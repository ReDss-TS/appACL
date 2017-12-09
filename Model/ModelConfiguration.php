<?php

class ModelConfiguration extends CoreModel
{
    //behaviour components
    protected $components = ['Validate'];
    
    public function selectData()
    {
        $selectQuery = "SELECT * FROM Configuration";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }
}
