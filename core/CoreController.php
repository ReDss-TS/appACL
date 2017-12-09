<?php

abstract class CoreController
{

    function __construct()
    {

        foreach ($this->models as $key => $property) {
            $this->{$property} = new $property;
        }

        foreach ($this->components as $key => $property) {
            $class = 'ControllerComponent' . $property;
            $this->{$property} = new $class;
        }
    }

    /**
     * Check user authentication for authorization and access rights
     * @param array $controller With controller name
     * @param array $action With action name
     * @param array $params With parameters
     */
    public function beforeCallAction($controller, $action, $params)
    {
        foreach ($this->actionsRequireLogin as $key => $value) {
            if ('action' . $value === $action) {
                if (!$this->Auth->isAuth() == true) {
                    header("Location: /user/login");
                    exit();
                }
            }
        }

        $acl = include('config/ACL.php');
        foreach ($acl as $key => $value) {  
            if (('Controller' . $key === $controller) || ('action' . $key === $action)) {
                try {
                    $this->Auth->accessСheck($value);
                } catch (ExceptionErrorPage $e) {
                    $e->createErrorPage('403');
                    exit();
                }
            }
        }
    }

    /**
     * get data from fields input by method POST
     * @param array $labels form input names
     * @return array
     */
    public function getInputValues($labels)
    {

        $inputValues = [];
        foreach ($labels as $key => $value) {
            if (isset($_POST[$value])) {
                $inputValues[$value] = $_POST[$value];
            } else {
                $inputValues[$value] = '';
            }
        }
        return $inputValues;
    }
}
