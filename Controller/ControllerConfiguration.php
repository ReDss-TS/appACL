<?php

class ControllerConfiguration extends CoreController
{   
    protected $models = ['ModelSessions', 'ModelConfiguration'];
    protected $components = ['Auth'];
    protected $actionsRequireLogin = ['Index'];

    public function actionIndex($param)
    {   
        $selectedData['data'] = $this->ModelConfiguration->selectData();
        return $selectedData;
    }

}
