<?php

class ErrorControler extends Controler {
   
    public function error404()
    {
            $this->view->display();
            $error=array("erreur", "404");
        $template = $this->twig->loadTemplate('/error404/display.html.twig');
       echo $template->render($error);
    }
}
