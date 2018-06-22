<?php

class MemeController extends Controler {
   public function display() {
      $limit= $this->route["params"];
      $upload = meme::uploadImage();
      $memes = meme::getListAll();
      $categories = meme::getAllCategories();
      $template = $this->twig->loadTemplate('/meme/display.html.twig');
      echo $template->render(array(
        'categories' => $categories,
        'memes' => $memes,
        'upload' => $upload,
       )); 
   }

   public function renderMeme(){
      $generateMeme = meme::generateMeme();
      $template = $this->twig->loadTemplate('/meme/display.html.twig');
      echo $template->render(array(
        'generateMeme' => $generateMeme
      ));
   }
}
