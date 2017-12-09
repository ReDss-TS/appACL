<?php

class ModelDashboard extends CoreModel
{
    //behaviour components
    protected $components = ['Validate'];
    
    public function selectData()
    {
        $selectQuery = "SELECT * FROM Dashboard";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }
}
