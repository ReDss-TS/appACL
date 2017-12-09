<?php

class ModelUser extends CoreModel
{
    //behaviour components 
    protected $components = ['Validate'];
    
    public function selectPasswordByLogin($login)
    {
        $dataForEscape['login'] = $login;
        $escapedData = CoreDB::getInstance()->escapeData($dataForEscape);
        $selectQuery = "SELECT * FROM users where login = '" . $escapedData['login'] . "'";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertUserIntoDB($values)
    {
        $escapedData = CoreDB::getInstance()->escapeData($values);
        $insertUserQuery = "INSERT INTO users (lastName, firsName, login, pass, role_id) 
                                VALUES ('" . $escapedData['user_lastName'] . "', 
                                        '" . $escapedData['user_firsName'] . "',
                                        '" . $escapedData['user_login'] . "',
                                        '" . $escapedData['user_pass'] . "',
                                        '" . $escapedData['user_role'] . "');";
                                        
        $resultInsert = CoreDB::getInstance()->insertToDB($insertUserQuery);
        return $resultInsert;
    }

    public function getRoles($id)
    {
        $dataForEscape['id'] = $id;
        $escapedData = CoreDB::getInstance()->escapeData($dataForEscape);

        $selectQuery = (empty($id)) ? "SELECT * FROM role" : "SELECT * FROM role WHERE id = '" . $escapedData['id'] . "'";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }
}
