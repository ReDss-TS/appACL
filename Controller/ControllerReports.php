<?php

class ControllerReports extends CoreController
{   
    protected $models = ['ModelSessions', 'ModelReports'];
    protected $components = ['Auth'];
    protected $actionsRequireLogin = ['Index'];

    public function actionIndex($param)
    {   
        $selectedData['data'] = $this->ModelReports->selectData();
        return $selectedData;
    }

}
