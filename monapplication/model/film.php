<?php

class Film extends Model {

    public static function getFilm( $id ) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM films WHERE id_FILMS = :id";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue( ':id', $id, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getRealisateur( $id )
    {
      $db = Database::getInstance();
      $sql = 
      "SELECT * FROM realisateurs as r
       INNER JOIN films_realisateurs as fr
       ON r.id_REALISATEURS = fr.id_REALISATEURS_FR
       AND fr.id_FILMS_FR = :id
      ";
      $stmt = $db->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->bindValue( ':id', $id, PDO::PARAM_INT); 
      $stmt->execute();
      return $stmt->fetchAll();
    }

    public static function getGenre( $id )
    {
        $db = Database::getInstance();
        $sql = 
        "SELECT * FROM genres as g
         INNER JOIN films_genres as fg
         ON g.id_GENRES = fg.id_GENRES_FG
         AND fg.id_FILMS_FG = :id
        ";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue( ':id', $id, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll();
    }

   public static function getList()
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM films";
        $stmt = $db->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

   public static function getListRandom($limit) 
   {
        $db = Database::getInstance();
        $sql = "SELECT id_FILMS, titre_FILMS, image_FILMS  FROM films ORDER BY RAND() LIMIT :limit";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':limit', intval($limit), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
   }

   public static function lookforSearch( $saisie ) {
    
      $db = Database::getInstance();
      $sql = "SELECT id_FILMS, titre_FILMS FROM films WHERE titre_FILMS like :saisie ORDER BY titre_FILMS " ;
      $stmt = $db->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC
      $stmt->bindValue( ':saisie', $saisie, PDO::PARAM_STR); 
      $stmt->execute();//array(":id" => $idtitre
      return $stmt->fetchall();
   }

}

class searchfilm {

   public static function getInfoFilms($nomfilm){

   $bdd = new PDO('mysql:host=localhost;dbname=base_test;charset=utf8', 'root', '');
      $sql = "SELECT * FROM personne WHERE titre_FILMS = :nmp";
      $stmt = $bdd->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC
      $stmt->bindValue( ':nmp', $nomfilm, PDO::PARAM_STR); 
      $stmt->execute();//array(":id" => $id
      return $stmt->fetchall();

   }

   //$liste=$this ->getFromSaisie($saisie);

   //     foreach($row->selectnom as $liste) :
   //     echo $row->nom;
   //     endforeach;

}



////echo $_POST["saisie"];
//if (isset($_POST["saisie"])) {
//$listefilms=film::getFromSaisie($_POST["saisie"]);
////print_r($listenom);

//foreach ($listefilms as $films ) :
//echo $filmss['titre_FILMS'] .';';
//endforeach;
//}

//if (isset($_POST["infos"])) {
//$infos=searchfilm::getInfoFilms($_POST["infos"]);
////print_r($infos);

//foreach ($infos as $data ) :
//echo '<p class="spec_nom">' .$data['titre_FILMS'] .'</p>';
//echo '<p class="spec_mail">' .$data['mail'] .'</p>';
//echo '<p class="spec_tel">' .$data['Telephone'] .'</p>';
//endforeach;
//}