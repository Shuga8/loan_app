<?php

//the main part of my site 
//App Core Class
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        //check for first part of the url

        //look into controllers using ''ucwords for capitalized to check if first letter is capitallized

        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        //require cointroller using require_once
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;


        //check for the second part of the url

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        //get parameters
        $this->params = $url ? array_values($url) : [];

        //call back an array of parameters

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    //get url
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');

            //filter url into strings and numbers
            $url = filter_var($url, FILTER_SANITIZE_URL);

            //explode url into an array and break at /
            $url = explode('/', $url);

            return $url;
        }
    }
}