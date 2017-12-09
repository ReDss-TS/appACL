<?php

class ControllerDashboard extends CoreController
{   
    protected $models = ['ModelSessions', 'ModelDashboard'];
    protected $components = ['Auth'];
    protected $actionsRequireLogin = ['Index'];

    public function actionIndex($param)
    {   
        $selectedData['data'] = $this->ModelDashboard->selectData();
        return $selectedData;
    }

}
