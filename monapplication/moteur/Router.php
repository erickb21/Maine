<?php

class Router {
   public static function analyze( $query ) {
      $result = array(
         "controler" => "Error",
         "action" => "error404",
         "params" => array()
      );

      if($query === "find"){
            $saisie = strip_tags($_POST['saisie']);      
            $result["controler"] = "Index";
            $result["action"] = "initListSearch";
            $result["params"]["saisie"] =$saisie;
            }

      if($query === "meme"){
            $result["controler"] = "Meme";
            $result["action"] = "display";
            } 

      if( $query === "" || $query === "/" ){
         $result["controler"] = "Index";
         $result["action"] = "display";
         //$result["action"] = "random";
         $result["params"]["limit"] = 4;

      } else { 
            /* $parts = explode("/", $query);
         if($parts[0] == "meme" && count($parts) == 1) { */
            $result["controler"] = "Meme";
            $result["action"] = "display";
/*             $result["params"] = $parts[1];            
 */         /* } */
      }
      //print_r($result);
      return $result;
/*       print_r($result);
 */           
      }
}
         /* $parts = explode("/", $query);
         //echo var_dump($parts);

         switch ($parts[0]):
         case "meme" :
             if (count($parts) == 2) 
                {            
                $result["controler"] = "Meme";
                $result["action"] = "display";
                $result["params"]["id"] = $parts[1]; 
                //print_r($result);
                }
              else {break;}
         break;
         case "random" :
            if (count($parts) == 2) 
            {            
            $result["controler"] = "Index";
            $result["action"] = "random";
            $result["params"]["limit"] = $parts[1]; 
            }
            else {break;}

         break;
         default:
         endswitch; */

         //if($parts[0] == "film" && count($parts) == 2) {
         //   $result["controler"] = "Film";
         //   $result["action"] = "display";
         //   $result["params"]["id"] = $parts[1];            
         //}

