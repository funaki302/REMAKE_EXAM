<?php
function dbconnect(){
  static $connect = null;
  if($connect === null){
      $connect = mysqli_connect('localhost','root','','emprunt');
      if(!$connect){
          die('Erreur de connection à la base de données : ' . mysqli_connect_error());
      }
      mysqli_set_charset($connect,'utf8mb4');
  }
  return $connect;
}
?>