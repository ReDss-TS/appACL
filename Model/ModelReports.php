<?php

class ModelReports extends CoreModel
{
    //behaviour components
    protected $components = ['Validate'];
    
    public function selectData()
    {
        $selectQuery = "SELECT * FROM Reports";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }
}
