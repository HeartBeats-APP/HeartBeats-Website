<?php
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');


$params = explode('/', $_GET['p']);

if($params[0] != ""){
    
    $controller = ucfirst($params[0]);
    $action = isset($params[1]) ? $params[1] : 'index';

    require_once(ROOT.'controllers/'.$controller.'.php');
    
    $controller = new $controller(); // TODO: figure out if this statement can be called in the if statement below

    if(method_exists($controller, $action)) 
    {
        $controller->$action();
    } 
    else 
    {
        http_response_code(404);
        echo '404';
    }

    $controller->$action();

} else {

    require_once(ROOT.'controllers/Home.php');
    $controller = new Home();
    $controller->index();
    
}

?>