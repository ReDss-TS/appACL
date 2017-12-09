<?php

class ViewUserRegister extends CoreView
{
    protected $helpers = ['Sessions', 'Forms'];
    
    //elements for html form
    protected $elements  = [
            'header'     => 'Register',
            'submitBtn'  => 'Register',
            'backBtn'    => 'user/Login',
    ];

    //structure of the input field
    protected $structure  = [
            [
                'name'  => 'user_lastName',
                'label' => 'Last Name',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_firsName',
                'label' => 'Firs Name',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_login',
                'label' => 'Login',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_pass',
                'label' => 'Password',
                'type'  => 'Password'
            ],
            [
                'name'  => 'user_role',
                'label' => 'Role',
                'type'  => 'select'
            ]
    ];
    
    public function render()
    {
        $html = '';
        $html .= $this->Forms->startForm($this->elements);
        foreach($this->structure as $field) {
            $html .= $this->renderInputField($field);
        }
        $html .= $this->Forms->submitBtn($this->elements);
        $html .= $this->Forms->endForm();
        echo $html;
    }

    private function renderInputField($field)
    {
        $renderedField = '';
        $data = $this->Forms->getFieldData($field['name']);
        $renderedField .= $this->Forms->renderInput($field, $data);
        return $renderedField;
    }
}
