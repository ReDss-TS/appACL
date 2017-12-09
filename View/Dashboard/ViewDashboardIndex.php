<?php

class ViewDashboardIndex extends CoreView
{
    protected $helpers = ['Sessions'];
    
    public function render($data)
    {
        $html = '';
        $html .= "<h1>" . $data['data'][0]['title_record'] .  "<h1/>";
        $html .= "<h2>" . $data['data'][0]['text_record'] .  "<h2/>";
        echo $html;
    }
}
