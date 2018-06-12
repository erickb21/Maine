<?php

class IndexController extends Controler {
   
    public function display()
    {
        $limit = $this->route["params"]["limit"];
        $randomFilms = Film::getListRandom($limit);

   
        $template = $this->twig->loadTemplate('/index/display.html.twig');
        echo $template->render(array(
            'randomFilms'  => $randomFilms
        ));

    }

    public function initListSearch(){
    $saisie = $this->route["params"]["saisie"];
    $listeFilms = Film::lookforSearch($saisie);
    
//print_r($listeFilms);
    foreach ($listeFilms as $films ) :

    echo $films['id_FILMS'] .':'.$films['titre_FILMS'] .';';
    endforeach;


    //echo $listeFilms;
        //    $template = $this->twig->loadTemplate('/index/display.html.twig');
        //echo $template->render(array(
        //    'randomFilms'  => $randomFilms
        //));
    }
}
