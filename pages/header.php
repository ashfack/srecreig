<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['id']))
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
            <a class="navbar-brand" href="index.php">Service Relations Entreprises	</a>
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
                    <li><a href="rechercher_alternant.php"><i class="fa fa-graduation-cap"></i> Alternant</a>
                    </li>
                </ul>
            </li>
            <?php
                if($_SESSION['profil']!='read')
                {
            ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="formulaireEntreprise.php">
                            <i class="fa fa-plus fa-fw"></i> 
                        </a>
                    </li>
            <?php    
                }
            ?>        
            <?php
                if($_SESSION['profil']=='super')
                {
            ?>            
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="exporter_critere.php">
                            <i class="glyphicon glyphicon-download"></i> 
                        </a>
                    </li>
            <?php    
                }
            ?>            
           
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa"></i>  <i class="glyphicon glyphicon-cloud"></i>
                </a>
                <ul class="dropdown-menu ">
                    <li><a href="up_fic.php"><i class="glyphicon glyphicon-cloud-upload"></i> Joindre Fichier</a>
                    </li>
                    <li><a href="Stockage.php"><i class="glyphicon glyphicon-cloud"></i> Espace stockage</a>
                    </li>
                </ul>
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
                    <?php
                        if($_SESSION['profil']=='super')
                        {
                            echo " <li><a href='gestion_profils.php'><i class='fa fa-gear fa-fw'></i> Gestion des profils</a></li>";
                        }
                    ?>
                    <li><a href="deconnexion.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
