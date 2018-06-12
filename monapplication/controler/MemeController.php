<?php

class MemeController extends Controler {
   public function display() {
      $slug = $this->route["params"]["id"];
      $meme = meme::getMeme($slug);
      $realisateur = meme::getRealisateur($meme['id_FILMS']);
      $genre = meme::getGenre($meme['id_FILMS']);

      $template = $this->twig->loadTemplate('/meme/display.html.twig');
      echo $template->render(array(
        'meme' => $meme,
        'realisateur' => $realisateur,
        'genre' => $genre
      ));
   }

      public function find() {
      $slug = $this->route["params"]["titre"];
      $meme = meme::getMeme($slug);
      $realisateur = meme::getRealisateur($meme['id_FILMS']);
      $genre = meme::getGenre($meme['id_FILMS']);

      $template = $this->twig->loadTemplate('/meme/display.html.twig');
      echo $template->render(array(
        'meme' => $meme,
        'realisateur' => $realisateur,
        'genre' => $genre
      ));
   }

}
