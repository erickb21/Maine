<?php

class meme extends Model {

    public static function getMeme($params){
        $db = Database::getInstance();
        $sql = "SELECT * FROM images WHERE 1=1 LIMIT :limit";
        
        if (isset($params['category'])){
            $sql .= "AND ima_category =" .$params['category'];
        }

        if(isset($params['date'])){
            $sql .= "ORDER BY ima_date" .$params['date'];
        }
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':limit', intval($limit), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getListRandom($limit){
        $db = Database::getInstance();
        $sql = "SELECT * FROM images ORDER BY RAND() LIMIT :limit";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':limit', intval($limit), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
   }

   public static function getListAll(){
    $db = Database::getInstance();
    $sql = "SELECT * FROM images ORDER BY RAND()";
    $stmt = $db->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

    public static function getSearch($parameters, $limit){
        $db = Database::getInstance();
        $sql = "SELECT * FROM images WHERE 1 = 1";
        if(isset($parameters['category']) && $parameters['category'] != ''){
            $sql .= " and ima_category = " .$db->quote($parameters['category'], PDO::PARAM_INT);
        }
        if(isset($parameters['date']) && $parameters['date'] != ''){
            $sql .= " order by ima_date " .$parameters['date'];
        }
        
        $sql .= ' limit :limit ';

        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':limit', intval($limit), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

   public static function getAllCategories(){
    $db = Database::getInstance();
    $sql = "SELECT * FROM categories" ;
    $stmt = $db->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC
    $stmt->execute();//array(":id" => $idtitre
    return $stmt->fetchall();
   }
   

/*    public static function lookforSearch( $saisie ) {
    
      $db = Database::getInstance();
      $sql = "SELECT id_FILMS, titre_FILMS FROM films WHERE titre_FILMS like :saisie ORDER BY titre_FILMS " ;
      $stmt = $db->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC
      $stmt->bindValue( ':saisie', $saisie, PDO::PARAM_STR); 
      $stmt->execute();//array(":id" => $idtitre
      return $stmt->fetchall();
   } */
}

/* class searchMeme {

   public static function getInfoMemes($nommeme){

   $bdd = new PDO('mysql:host=localhost;dbname=base_test;charset=utf8', 'root', '');
      $sql = "SELECT * FROM personne WHERE titre_FILMS = :nmp";
      $stmt = $bdd->prepare($sql);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC
      $stmt->bindValue( ':nmp', $nommeme, PDO::PARAM_STR); 
      $stmt->execute();//array(":id" => $id
      return $stmt->fetchall();

   }
} */

/*     public static function getMeme( $id ) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM images LIMIT 2";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue( ':id', $id, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch();
    } */



