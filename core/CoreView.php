<?php

abstract class CoreView
{

    function __construct($data)
    {
        foreach ($this->helpers as $key => $property) {
            $class = 'ViewHelpers' . $property;
            $this->{$property} = new $class($data);
        }
    }

    public function renderForm($data)
    {
    	$renderForms = new ViewHelpersForms($data);
    	$form = $renderForms->render($this->structure, $this->elements);
    	return $form;
    }


    public function renderTable($data)
    {
    	$dataForTable = $this->renderData($data);

        $renderTables = new ViewHelpersTable($data);
    	$table = $renderTables->render($this->columnNames, $this->additionalСolumns, $dataForTable);
    	return $table;
    }

    public function getColumnNames()
    {
        if (isset($this->columnNames)) {
            return $this->columnNames;
        }
        return false;
    }
}
