<?php
    require("security.php");    
    require("../db_connect.php");
    
    // idCoordonnesPersonne : id de la personne CQFD
    // idAux : id de l'atelierRH, de la conférence, ou de l'entreprise
    // assoc : indique si c'est atelierRH, conference ou entreprise
    // valeurs de assoc : Entreprise, AtelierRH, Conference
    if(isset($_POST['idCoordonneesPersonne'])&& isset($_POST['idAux']) &&isset($_POST['assoc'])) 
    {
        $idCP=  $_POST['idCoordonneesPersonne'];
        $idAux= $_POST['idAux'];
        $assoc= $_POST['assoc'];
        if ($assoc =="Entreprise")
        {
            $type = $_POST['type'];
            $rep = $conn->prepare("INSERT INTO a_".$assoc."_CoordonneesPersonne VALUES ?,?,?");
            $rep->execute(array($idAux,$idCP,$type));
        }
        else
        {
            $rep = $conn->prepare("INSERT INTO a_".$assoc."_CoordonneesPersonne VALUES ?,?");
            $rep->execute(array($idAux,$idCP));
        }
    }
?>
