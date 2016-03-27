<?php
    session_start();
    if (! isset($_SESSION['id']))
    {
        echo 'Session expirée, veuillez vous reconnecter !';
        echo "Cliquez <a href=\"page.php\">ici</a>"; 
        exit();
    } 
	header('Content-Type: text/html; charset=utf-8');
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Service Relations Entreprise</title>

    <!-- Bootstrap Core CSS -->
    <link href="../framework/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/header.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../framework/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Service Relations Entreprise	</a>
            </div>
            
            
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            
           
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-search fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="rechercher.php"><i class="fa fa-university fa-fw"></i> Entreprise</a>
                        </li>
                        <li><a href="rechercher.php"><i class="fa fa-globe fa-fw"></i> Globale</a>
                        </li>
                     
                    </ul>

                </li>

                

                <li class="dropdown">
                    <a class="dropdown-toggle" href="ajoutEntreprise.php">
                        <i class="fa fa-plus fa-fw"></i> 
                    </a>
                </li>
                
                
                <li class="dropdown">
                    <a class="dropdown-toggle" href="exporter_critere.php">
                        <i class="fa fa-save fa-fw"></i> 
                    </a>
                </li>
   
                

                <li class="dropdown">
                    <a class="dropdown-toggle" href="agenda.php">
                        <i class="fa fa-calendar fa-fw"></i> 
                    </a>
                </li>
                

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

                        <li><a href="profils.php"><i class="fa fa-gear fa-fw"></i> Gestion des profils</a></li>
                        <li><a href="deconnexion.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a></li>
                    </ul>

                </li>

            </ul>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="../framework/bootstrap/js/bootstrap.min.js"></script>


</body>

</html>