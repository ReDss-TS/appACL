<?php

class ModelBehaviourValidate
{
    public function validateData($data, $validationRules)
    {
        $errorList = [];
        foreach ($validationRules as $keyRules => $valueRules) {
            foreach ($valueRules as $k => $rule) {
                if (isset($data[$keyRules])) {
                    $response = $this->$rule($data[$keyRules]);
                    $errorList[$keyRules] = $response;
                    if ($response != '') {
                        break;
                    }
                }
            }
        }
        return $errorList;
    }
    
    private function isValidText($text)
    {
        if (empty($text)) {
            return '';
        }
        if (!preg_match("/[A-Za-z0-9\x20]+/", $text)) {
            return 'Invalid characters!';
        }
        return '';
    }

    private function isValidLogin($text)
    {
        if (!preg_match("/[A-Za-z0-9-_.\'\"]+$/", $text)) {
            return 'Invalid characters!';
        }
        return '';
    }

    private function isValidPass($text)
    {
        if (strlen($text) > 3) {
            return '';
        }
        return 'Not enough characters! Password must be at least 4 characters!';
    }

    private function notEmpty($value)
    {
        if (!empty($value)) {
            return '';
        }
        return 'The field can not be empty';
    }

    private function isValidRole($value)
    {
        if ($value !== '0' ) {
            return '';
        }
        return 'The choice has not been made';
    }
}
