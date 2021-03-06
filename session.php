<?php
session_start();

//do katerih strani ima uporabnik dostop
$allow = ['/apartmaji/login.php','/apartmaji/register.php','/apartmaji/index.php','/apartmaji/login_check.php'];

//preverim ali je uporabnik prijavljen, če ni ga peljem na prijavo
if(!isset($_SESSION['user_id']) && (!in_array($_SERVER['REQUEST_URI'],$allow)))
{
    header("Location: login.php");
    die();
}

function getFullName($user_id) {
    require "database.php";

    $query = "SELECT * FROM osebe WHERE id_osebe = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);

    $osebe = $stmt->fetch();
    return $osebe['ime'].' '.$osebe['priimek'];
}

//vrača za trenutnega prijavljenega uporabnika
function admin(){
    return $_SESSION['admin'];
}

//če trenutno prijavljeni ni admin, ga preusmeri na index
function adminOnly(){
   if(!isset($_SESSION['admin']) || ($_SESSION['admin'] !=1)){
     header("Location: index.php");
     die();
   }
}

function odziv($message){
   // session_start();
   $_SESSION['odziv'] = $message;
}

?>