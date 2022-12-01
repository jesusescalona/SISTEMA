<?php
   
   class vistasModelo{

      /*--------- Modelo obtener vistas ---------*/
      protected static function obtener_vistas_modelo($vistas){
         $listaBlanca=["almacen-list", "almacen-new","alamcen-search","almacen-update","prod-list","prod-new","prod-search","prod-update","company","home","item-list","item-new","item-search","item-update","reservation-list","reservation-new","reservation-pending","reservation-search","reservation-update","user-list","reservation-reservation","user-new","user-search","user-update","config-sys", "dep-new"];
         if(in_array($vistas, $listaBlanca)){
            if(is_file("./Vistas/contenidos/".$vistas."-view.php")){
               $contenido="./Vistas/contenidos/".$vistas."-view.php";
            }else{
               $contenido="404";
            }
         }elseif($vistas=="login" || $vistas=="index"){
            $contenido="login";
         }else{
            $contenido="404";
         }
         return $contenido;
      }
   }



