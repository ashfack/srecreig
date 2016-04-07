<?php

require'db_connect.php';
$tab_donnees=array();

if(isset($_POST['table']) && $_POST['table']!="" && isset($_POST['liste_choix']) && $_POST['liste_choix']!="")
{
    $choix=$_POST['liste_choix'];  
    $list=explode(",",$choix);
    $table=$_POST['table']; 
   // echo $choix;
    $sql = "SELECT ".$choix." FROM ".$table.";";
    $rep = $conn->prepare($sql);
    $rep->execute();
    for($i=0;$i<count($list);$i++)
    {
        $champs_tmp[$i]=explode(".",$list[$i])[1];
    }
    /*for($i=0;$i<count($champs_tmp);$i++)
    {
           $champs[$i] = $champs_tmp[$i][1] ; 

    }*/
    //print_r($champs_tmp);
   
    while ($donnees = $rep->fetch())
    {
         $arraytablee=array();
        foreach ($champs_tmp as $value) 
        {
            array_push($arraytablee,$donnees[$value]);
            //$arraytablee[$key]= $donnees[$value];
        //   echo $arraytablee[$key]." ";            
        }
       // array_push($arraytablee,$tab_int);
        //print_r($arraytablee);
        //echo "<br/>";
       
        array_push($tab_donnees, $arraytablee);  
    }
    //print_r($tab_donnees);
    
}
     echo json_encode( $tab_donnees);
?>