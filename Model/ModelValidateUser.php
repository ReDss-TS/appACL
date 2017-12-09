<?php

class ModelValidateUser extends CoreModel
{
    protected $components = ['Validate'];
    
    protected $validationRules = [
        'user_lastName' => [
            'notEmpty',
            'isValidText'
        ],
        'user_firsName' => [
            'notEmpty',
            'isValidText'
        ],
        'user_login' => [
            'notEmpty',
            'isValidLogin'
        ],
        'user_pass' => [
            'notEmpty',
            'isValidPass'
        ],
        'user_role' => [
            'notEmpty',
            'isValidRole'
        ]
    ];

    public function isBusyLogin($login)
    {
        $ModelUser = new ModelUser;
        $selectedLogin = $ModelUser->selectPasswordByLogin($login);
        if (is_object($selectedLogin)) {
            return false;
        } else {
            return true;
        }
    }
}
