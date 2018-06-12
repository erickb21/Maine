<?php

class IndexController extends Controler {
   
    public function display()
    {
        $limit = $this->route["params"]["limit"];
        $randommemes = meme::getListRandom($limit);

   
        $template = $this->twig->loadTemplate('/index/display.html.twig');
        echo $template->render(array(
            'randommemes'  => $randommemes
        ));

    }

    public function initListSearch(){
    $saisie = $this->route["params"]["saisie"];
    $listememes = meme::lookforSearch($saisie);
    
//print_r($listememes);
    foreach ($listememes as $memes ) :

    echo $memes['id_FILMS'] .':'.$memes['titre_FILMS'] .';';
    endforeach;


    //echo $listememes;
        //    $template = $this->twig->loadTemplate('/index/display.html.twig');
        //echo $template->render(array(
        //    'randommemes'  => $randommemes
        //));
    }
}
