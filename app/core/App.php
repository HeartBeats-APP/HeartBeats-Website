<?php
class App
{
    protected $controller = 'home'; // default controller
    protected $method = 'index'; // default method
    protected $params = []; // default params (optional arguments in the url)

    public function __construct()
    {

        $url = $this->parseUrl();

        if (file_exists('../app/controllers/' . $url[0] . '.php')) // Route request to the appropriate controller
        {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) // Route request to the appropriate method of the controller
        {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        } else {
            $this->method = 'index';
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params); // Call the method of the controller with the optional arguments

    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

            //If the first element of the url is empty, remove it
            if ($url[0] == 'public' || $url[0] == "" || $url[0] == "Public" || $url[0] == "env" || $url[0] == "Env") {
                unset($url[0]);
            }
            return $url;
        }
    }
}
