<?php

try{
    $connect = new PDO("mysql:host=localhost;dbname=filmarsivi;port=3308;charset=utf8;","root","");

}catch(PDOException $mesaj){
    echo $mesaj->getMessage();
}



?>