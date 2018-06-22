<?php

class meme extends Model {

    public static function getMeme($params){
        $db = Database::getInstance();
        $sql = "SELECT * FROM images WHERE 1=1 LIMIT :limit";
        
        if (isset($params['category'])){
            $sql .= "AND mem_category =" .$params['category'];
        }

        if(isset($params['date'])){
            $sql .= "ORDER BY mem_date_creation" .$params['date'];
        }
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':limit', intval($limit), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getRandomMemes($limit){
        $db = Database::getInstance();
        $sql = "SELECT * FROM memes ORDER BY RAND() LIMIT :limit";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindValue(':limit', intval($limit), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
   }

   public static function getListAll(){
    $db = Database::getInstance();
    $sql = "SELECT * FROM images";
    $stmt = $db->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    return $stmt->fetchAll();
}

    public static function getAllMemes(){
        $db = Database::getInstance();
        $sql = "SELECT * FROM memes";
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getSearch($parameters, $limit){
        $db = Database::getInstance();
        $sql = "SELECT * FROM memes WHERE 1 = 1";
        if(isset($parameters['category']) && $parameters['category'] != ''){
            $sql .= " and mem_category = " .$db->quote($parameters['category'], PDO::PARAM_INT);
        }
        if(isset($parameters['date']) && $parameters['date'] != ''){
            $sql .= " order by mem_date_creation " .$parameters['date'];
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

public static function uploadImage(){
    if (isset($_POST['submit'])){
        $db = Database::getInstance();

        $imageCategory = $_POST['imageCategory'];
        $imageName = $_POST['imageName'];
        $target_dir = "img/uploads/";
        $target_file = basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $targetFilePath = $target_dir . $target_file;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            echo "Désolé, l'image existe déjà.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Désolé, la taille de votre image est trop importante.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Désolé, seul les fichiers JPG, JPEG, PNG sont acceptés.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Désolé, il y a eu un problème lors de l'importation de votre image.";

        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                $insert = $db->query("INSERT into images (ima_category, ima_title, ima_url, ima_date) VALUES ('$imageCategory', '".$imageName."', '".$targetFilePath."', UNIX_TIMESTAMP())");
            echo "Votre image" .$imageName. "a bien été importé.";
            } else {
                echo "Désolé, votre image" .$imageName. "n'a pas pu être importé.";
            }
        }
    }
}

public static function generateMeme(){

    $db = Database::getInstance();

    $hex1 = $_POST['textColor1'];
    $hex2 = $_POST['textColor2'];

    function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);
    
        if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }

    function get_center_text_position($img_width, $fontSize, $fontFile, $string) {

            $bounding_box_size = imagettfbbox($fontSize, 0, $fontFile, $string);
            $text_width = $bounding_box_size[2] - $bounding_box_size[0];
                 
          return ceil(($img_width - $text_width) / 2);
        }
        

    if (isset($_POST['txt1'])) {

        $text1 = $_POST['txt1'];
        $text2 = $_POST['txt2'];

        $memeTitle = htmlentities($_POST['memeTitle']);
        $memeDescription = $_POST['memeDescription'];
        $memeCategory = $_POST['memeCategory'];

        $Color1 = hex2rgb($hex1);
        $rColor1 = $Color1[0];
        $gColor1 = $Color1[1];
        $bColor1 = $Color1[2];

        $Color2 = hex2rgb($hex2);
        $rColor2 = $Color2[0];
        $gColor2 = $Color2[1];
        $bColor2 = $Color2[2];

        $urlImg = $_POST['currentImagePath'];
        $info = new SplFileInfo($urlImg);
        $extImage = $info->getExtension();
        $memeRendered = "img/meme_rendered/";

        $fontFile = 'fonts/impact.ttf';
        $fontSize = 30;


        if($extImage == "png"){
            header ("Content-type: image/png");
            $image = imagecreatefrompng($urlImg);
            $couleur_fond1 = ImageColorAllocate ($image, $rColor1, $gColor1, $bColor1);
            $couleur_fond2 = ImageColorAllocate ($image, $rColor2, $gColor2, $bColor2);
            
            $img_width = getimagesize($urlImg);

            imagettftext($image, $fontSize, 0, get_center_text_position($img_width[0], $fontSize, $fontFile, $text1), 50, $couleur_fond1, $fontFile, $text1);


            if (isset($_POST['txt2'])){
                imagettftext($image, $fontSize, 0, get_center_text_position($img_width[0], $fontSize, $fontFile, $text2), 375, $couleur_fond2, $fontFile, $text2);
            }

            ImagePng ($image, $memeRendered.$memeTitle.'.'.$extImage);
            $memeUrl = $memeRendered.$memeTitle.'.'.$extImage;
        }
        
        if($extImage == "jpg" || $extImage == "jpeg"){
            header ("Content-type: image/png");
            $image = imagecreatefromjpeg($urlImg);
            $couleur_fond1 = ImageColorAllocate ($image, $rColor1, $gColor1, $bColor1);
            $couleur_fond2 = ImageColorAllocate ($image, $rColor2, $gColor2, $bColor2);
            
            $img_width = getimagesize($urlImg);

            imagettftext($image, $fontSize, 0, get_center_text_position($img_width[0], $fontSize, $fontFile, $text1), 50, -$couleur_fond1, $fontFile, $text1);


            if (isset($_POST['txt2'])){
                imagettftext($image, $fontSize, 0, get_center_text_position($img_width[0], $fontSize, $fontFile, $text2), 375, $couleur_fond2, $fontFile, $text2);
            }

            Imagejpeg ($image, $memeRendered.$memeTitle.'.'.$extImage);
            $memeUrl = $memeRendered.$memeTitle.'.'.$extImage;
        }

        if($extImage !== "jpg" && $extImage !== "jpeg" && $extImage !== "png"){
            echo "Une erreur est survenue lors de la génération du Meme";
        }

        $insert = $db->query("INSERT into memes (mem_title, mem_description,mem_category, mem_url, mem_date_creation, mem_date_update) VALUES ('$memeTitle', '$memeDescription','$memeCategory', '$memeUrl', UNIX_TIMESTAMP(), UNIX_TIMESTAMP())");

    }

    echo $memeUrl.'!!';

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



