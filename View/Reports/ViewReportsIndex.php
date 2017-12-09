<?php

class ViewReportsIndex extends CoreView
{
    protected $helpers = ['Sessions'];
    
    public function render($data)
    {
        $html = '';
        $html .= "<h1>" . $data['data'][0]['title_report'] .  "<h1/>";
        $html .= "<h2>" . $data['data'][0]['text_report'] .  "<h2/>";
        echo $html;
    }
}
