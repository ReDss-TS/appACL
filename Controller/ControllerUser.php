<?php

class ControllerUser extends CoreController
{
    protected $models = ['ModelSessions', 'ModelUser', 'ModelValidateUser'];
    protected $components = ['Auth'];
    protected $actionsRequireLogin = [];

    public function actionLogin()
    {
        if ($_POST) {
            $this->authentication();
        }
        if ($this->ModelSessions->issetLogin() == true) {
            $this->locationMainPage();
        }
        return null;
    }

    public function actionRegister()
    {
        $formData = [];
        $formData['roles'] = $this->ModelUser->getRoles('');
        if ($_POST) {
            $registerData = $this->registration();
            $formData = (!is_array($registerData)) ? $formData : array_merge($formData, $registerData);
        }
        $formData['isAuth'] = $this->ModelSessions->issetLogin();
        return $formData;
    }

    public function actionLogout()
    {
        session_destroy();
        header("Location: /user/login");
    }

    public function locationMainPage()
    {
        $uri = include('config/defController.php');
        header("Location: /" . $uri['controller'] . '/' . $uri['action']);
    }
    
    private function authentication()
    {
        $auth = $this->Auth->auth($_POST['user_login'], $_POST['user_pass']);
        if ($auth['is_auth'] === true) {
            $this->ModelSessions->authenticationToSession($auth['user']['id'], $auth['user']['login'], $auth['user']['role_id']);
        } else {
            $this->ModelSessions->recordMessageInSession('auth', $auth);
        }
    }

    private function registration()
    {
        $inputFields = include('config/inputFields.php');

        $inputValues = $this->getInputValues($inputFields['register']);

        $validateList = $this->ModelValidateUser->validateData($inputValues);
        $noEmptyValidateList = array_diff($validateList, array(''));

        if (empty($noEmptyValidateList)) {
            try {
                $result = $this->register($inputValues);
                $this->ModelSessions->recordMessageInSession('register', $result);
                return '';
            } catch (Exception $e) {
                echo 'Exception: ',  $e->getMessage(), "\n";//TODO
            }
        } else {
            $formData['data'] = $inputValues;
            $formData['validate'] = $validateList;
        }
        return $formData;
    }

    public function register($values)
    {   
        $msg = [];
        $values['user_pass'] = md5(trim($values['user_pass']));
        $ModelValidateUser = new ModelValidateUser;
        
        $isBusyLogin = $this->ModelValidateUser->isBusyLogin($values['user_login']);

        if ($isBusyLogin === true) {
            $msg['busyLogin'] = true;
        } elseif ($isBusyLogin === false) {
            $msg['registered'] = $this->ModelUser->insertUserIntoDB($values);
        } else {
            throw new Exception('Error: User data has not been added');
        }
        return $msg;
    }
}
