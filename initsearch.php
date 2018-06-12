<?php
define("ROOT", realpath(__dir__)); 
require_once(ROOT . "\monapplication\moteur\Kernel.php");
//print_r($_POST["infos"]);
if (isset($_POST["saisie"])){kernel::initListSearch("find");}

//if (isset($_POST["infos"])){ 
//kernel::SearchFilm($_POST["infos"]);
//}

//
//print_r($_POST["saisie"]);

//require_once("index.php");
//echo "toto";

//Router::run();


//class searchfilm {

//   public static function getFromSaisie( $saisie ) {

//        $bdd = new PDO('mysql:host=localhost;dbname=base_test;charset=utf8', 'root', '');
//      $sql = "SELECT personne.nom FROM personne WHERE nom like :saisie";
//      $stmt = $bdd->prepare($sql);
//      $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC
//      $stmt->bindValue( ':saisie', $saisie, PDO::PARAM_STR); 
//      $stmt->execute();//array(":id" => $id
//      return $stmt->fetchall();

//   }

//   public static function getInfoFilms($nomfilm){

//   $bdd = new PDO('mysql:host=localhost;dbname=base_test;charset=utf8', 'root', '');
//      $sql = "SELECT * FROM personne WHERE nom = :nmp";
//      $stmt = $bdd->prepare($sql);
//      $stmt->setFetchMode(PDO::FETCH_ASSOC);//FETCH_ASSOC
//      $stmt->bindValue( ':nmp', $nomfilm, PDO::PARAM_STR); 
//      $stmt->execute();//array(":id" => $id
//      return $stmt->fetchall();

//   }

//   //$liste=$this ->getFromSaisie($saisie);

//   //     foreach($row->selectnom as $liste) :
//   //     echo $row->nom;
//   //     endforeach;

//}

////echo $_POST["saisie"];
//if (isset($_POST["saisie"])) {
//$listefilms=searchfilm::getFromSaisie($_POST["saisie"]);
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