<!-- <link rel="stylesheet" href="../framework/jsTree/dist/themes/default/style.min.css" />
<script src="../framework/jsTree/dist/jstree.min.js"></script>
<script  src="../js/jstree_cycle.js"></script> -->

<?php
require ("db_connect.php");

echo " <div id=\"jstree_bis\">";
$sql = "Select idCycleformation, cycle from CycleFormation where mention is null ";
try
{
    $rep = $conn->query($sql);
 

    while ($row = $rep->fetch())
    {
        echo " <ul > 
         <li id='".$row['idCycleformation']."' data-jstree='{\"icon\":\"fa fa-graduation-cap\"}'>" . $row['cycle'] . " 
            <ul>  ";
        $sql2 = "Select idCycleformation, mention from CycleFormation where mention is not null and specialite is null and cycle = \"" . $row['cycle'] . "\" ";
   
        $rep2 = $conn->query($sql2);

        while ($row2 = $rep2->fetch())
        {

            echo " <li id='".$row2['idCycleformation']."'  data-jstree='{\"icon\":\"fa fa-arrow-right\"}'>".$row2['mention']." 
                  <ul> ";

            $sql3 = "Select idCycleformation, specialite from CycleFormation where specialite is not null and cycle is not null and cycle = \"". $row['cycle'] . "\" and mention = \"" . $row2['mention'] . "\"";
    
            $rep3 = $conn->query($sql3);
      
            while ($row3 = $rep3->fetch())
            {
                echo " <li id='".$row3['idCycleformation']."' data-jstree='{\"icon\":\"fa fa-long-arrow-righthj\"}'>".$row3['specialite']." </li>  ";
            }

            echo "</ul></li> ";
      }
   echo "
        </ul>      
       </li>    
    </ul>  ";
   }
echo "     </div> ";

}
catch(PDOException $e)
{
   echo "Impossible de joindre le serveur de base de données";
}
?>
