<!DOCTYPE html>
<html>
    <head>
        <link href="/styles/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="header" id="myHead">
            <h3>
                APPLICATION
            </h3>
        </div>
        <hr/>
        <ul>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/reports">Reports</a></li>
            <li><a href="/configuration">Configuration</a></li>
            <li><a href="/user/register">Register</a></li>
            <li><a href="/user/logout">Logout</a></li>
        </ul>
        <hr/>
        <?php
            $session = new ViewHelpersSessions();
            if (class_exists($view)) {
                $content = new $view($data);
                $session->showMessages();
                $content->render($data);
            }
        ?>
    
    </body>
</html>
