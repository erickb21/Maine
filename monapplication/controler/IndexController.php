<?php

class IndexController extends Controler {
   
    
    public function display()
    {
        if(isset($_POST['category']) && isset($_POST['submit'])){
            $limit = $this->route["params"]["limit"];
            $memes = meme::getSearch($_POST, $limit);
        }else{
            $limit = $this->route["params"]["limit"];
            $memes = meme::getRandomMemes($limit);
        }

        if(isset($_POST['submit2'])){
            $memes = meme::getAllMemes();
        }

        $categories = meme::getAllCategories();
        $template = $this->twig->loadTemplate('/index/display.html.twig');
        echo $template->render(array(
            'categories' => $categories,
            'memes'  => $memes,
        ));  
    }
}

    /* public function initListSearch(){
    $saisie = $this->route["params"]["saisie"];
    $listememes = meme::lookforSearch($saisie); */
    
//print_r($listememes);
    /* foreach ($listememes as $memes ) :

    echo $memes['id_FILMS'] .':'.$memes['titre_FILMS'] .';';
    endforeach;
 */

    //echo $listememes;
        //    $template = $this->twig->loadTemplate('/index/display.html.twig');
        //echo $template->render(array(
        //    'randommemes'  => $randommemes
        //));
    /* } */

/* public function display()
    {
        $limit = $this->route["params"]["limit"];
        $randomMemes = meme::getListRandom($limit);

   
        $template = $this->twig->loadTemplate('/index/display.html.twig');
        echo $template->render(array(
            'randomMemes'  => $randomMemes
        ));
    } */
