<?php
require("security.php");
require("../db_connect.php");


function colonne_null(&$tab_donnees)
{
    foreach ($tab_donnees as $key => $value) 
    {
            // echo ("A : \n");
            // echo $value;

        if($value=="NaN" || $value=="null" || $value=="undefined" || $value=="")
        {
            $tab_donnees[$key]="";
            }
    }
}


$tab_donnees=array();
$selectedFullTxt = " "; 
if(isset($_POST['table']) && $_POST['table']!="" && isset($_POST['liste_choix']) && $_POST['liste_choix']!="")
{
    $choix=$_POST['liste_choix'];  
    $list=explode(",",$choix);
    $table=$_POST['table']; 
   // echo $choix;
    if($_POST['selectedFullTable'] != "")
    {
        $selectedFullTable=$_POST['selectedFullTable']; 
        $i=0 ;
            $selectedFull=explode(",",$selectedFullTable);

            if($list[$i] != $selectedFull[$i])
            {
                $selectedFullTxt = $list[$i] ; 
             }
             else 
             {
                $selectedFullTxt = $list[$i].".*" ; 
            }

        for($i=1;$i<count($list);$i++)
        {     
            if($list[$i] != $selectedFull[$i])
            {
                $selectedFullTxt = $list[$i].",".$selectedFullTxt ; 
          
             }
             else 
                $selectedFullTxt = $list[$i].".*,".$selectedFullTxt ; 

        }
        $sql = "SELECT ".$selectedFullTxt." FROM ".$table.";";
    }
    else 
    {
        $sql = "SELECT ".$choix." FROM ".$table.";";
    }
 
    $rep = $conn->prepare($sql);
    $rep->execute();

    for($i=0;$i<count($list);$i++)
    {
            if($_POST['selectedFullTable'] != "")
           {
            $champs_tmp[$i] = $list[$i];
           }
          else 
            $champs_tmp[$i]=explode(".",$list[$i])[1];
    }
   
    while ($donnees = $rep->fetch())
    {
        colonne_null($donnees);
        $arraytablee=array();
        foreach ($champs_tmp as $value) 
        {
            array_push($arraytablee,$donnees[$value]);        
        }
       
        array_push($tab_donnees, $arraytablee);  
    }

    
}
     echo json_encode( $tab_donnees);




?>


