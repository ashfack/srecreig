<?php
    session_start();
    if (! isset($_SESSION['id']))
    {
        echo 'Session expirée, veuillez vous reconnecter !';
        echo "Cliquez <a href=\"index.php\">ici</a>"; 
        exit();
    } 
	// header('Content-Type: text/html; charset=utf-8');
?>
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
                <ul class="dropdown-menu ">
                    <li><a href="rechercher.php"><i class="fa fa-university fa-fw"></i> Entreprise</a>
                    </li>
                    <li><a href="rechercherAlternant.php"><i class="fa fa-graduation-cap"></i> Alternant</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" href="formulaireEntreprise.php">
                    <i class="fa fa-plus fa-fw"></i> 
                </a>
            </li>
                        
            <li class="dropdown">
                <a class="dropdown-toggle" href="exporter_critere.php">
                    <i class="glyphicon glyphicon-download"></i> 
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

                    <li><a href="gestion_profils.php"><i class="fa fa-gear fa-fw"></i> Gestion des profils</a></li>
                    <li><a href="deconnexion.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->