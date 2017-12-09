<?php

class ViewConfigurationIndex extends CoreView
{
    protected $helpers = ['Sessions'];
    
    public function render($data)
    {
        $html = '';
        $html .= "<h1>" . $data['data'][0]['title_conf'] .  "<h1/>";
        $html .= "<h2>" . $data['data'][0]['text_conf'] .  "<h2/>";
        echo $html;
    }
}
