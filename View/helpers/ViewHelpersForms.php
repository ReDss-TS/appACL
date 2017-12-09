<?php

class ViewHelpersForms
{
    //array with input data and results of validation;
    protected $data = [];
    //array with keys to be contained in $data;
    protected $dataKeys = [
        'data',
        'validate',
        'roles'
    ];

    protected $fieldData;

    function __construct($formData) {
        $this->data = $formData;       
    }

    public function startForm($elements)
    {
        $form = "
            <div class = \"editBlock\" id = 'editBlock'>
                <form id='formValue' method = 'post' action=''>
                <div class = 'editBlockHead' id = 'editBlockHead'>
                    <h2>
                        " . $elements['header'] . "
                    </h2>
                </div>";
        return $form;
    }

    public function endForm()
    {
        $form = "
            </form>
            </div>";
        return $form;
    }

    public function getFieldData($name)
    {
        foreach ($this->dataKeys as $value) {
            $parameters[$value] = (isset($this->data[$value][$name])) ? $this->data[$value][$name] : '';
            if ($value == 'roles') {
                $parameters[$value] = (isset($this->data[$value])) ? $this->data[$value] : '';
            }
        }
        return $parameters;
    }

    public function renderInput($field, $parameters)
    {
        $name = $field['name'];
        $label = $field['label'];
        $type = $field['type'];

        if ($type == 'select') {
            $inputField = $this->getSelectField($name, $parameters);
        } else {
            $inputField = $this->getInputField($name, $type, $parameters);
        }

        $inputForm = "<div class = \"field\">
                    <label for ='$name'>$label:</label>
                    $inputField
                    <br/>
                    " . $parameters['validate'] . "
                    </div>";
        return $inputForm;
    }

    private function getInputField($name, $type, $parameters)
    {
        return "<input class = \"text\" id = '$name' name = '$name' type = '$type' value=\"" . $parameters['data'] . "\" />";
    }

    private function getSelectField($name, $parameters)
    {
        $SelectField = '';
        $SelectField .= "<select id = '$name' name = '$name'>";

        if ($this->data['isAuth'] !== true) {
            $SelectField .= "<option value =" . $parameters['roles'][0]['id'] . ">" . $parameters['roles'][0]['title'] . "</option>";
        } else {

            $SelectField .= '<option value = 0>make a choice</option>';
            foreach ($parameters['roles'] as $key => $value) {
                $SelectField .= "<option value =" . $value['id'] . ">" . $value['title'] . "</option>";
            }
        }

        $SelectField .= '</select>';
        return $SelectField;
    }
    public function submitBtn($elements)
    {
        $submitBtn = $elements['submitBtn'];
        $backLink = $elements['backBtn'];
        $backBtn = explode('/', $backLink);
        $btns = "<br/>
                <input class = 'button' type = 'submit' name = '" . $submitBtn . "Btn' value = '$submitBtn'/>
                <a href = '/$backLink' class='button'>$backBtn[1]</a>";
        return $btns;
    }
}
