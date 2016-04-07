<?php

require'db_connect.php';
$tab_donnees=array();

if(isset($_POST['table']) && $_POST['table']!="" && isset($_POST['liste_choix']) && $_POST['liste_choix']!="")
{
    $choix=$_POST['liste_choix'];  
    $list=explode(",",$choix);
    $table=$_POST['table']; 
    $sql = "SELECT ".$choix." FROM ".$table.";";
    $rep = $conn->prepare($sql);
    $rep->execute();
    for($i=0;$i<count($list);$i++)
    {
        $champs_tmp[$i]=explode(".",$list[$i]);
    }
    for($i=0;$i<count($champs_tmp);$i++)
    {
           $champs[$i] = $champs_tmp[$i][1] ; 

    }
    while ($donnees = $rep->fetch())
    {
        foreach ($champs as $key => $value) 
        {
            $arraytablee[$key]= $donnees[$value];
           echo $arraytablee[$key]." ";            
        }
        array_push($tab_donnees, $arraytablee);  
    }
}
     echo json_encode( $tab_donnees);
?>