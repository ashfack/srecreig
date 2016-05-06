<!DOCTYPE html>
<html>

<head>
    <title>Espace de stockage</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../css/style.css">
    <?php
    	require('header_link.html');
    ?>
    <?php
    	require('header_script.html');
    ?>
    <script src="../js/script_iframe.js"></script>
    <script src="../js/jquery.highlight.js"></script>
    <style>
        .highlight 
        {
        background-color: #8888ff;
        }
    </style>
</head>

<body>
    <?php require('header.php'); ?>

        <input id="nom" name="mot" type="search" size=20>
        <input type="button" id="Rechercher" value="Rechercher">    
    
    
    <iframe src="http://srecreig.alwaysdata.net/srecreig/files/" width="100%" height="500px" id="iframe1" marginheight="0" 
        frameborder="0" onLoad="autoResize('iframe1');">
      <p>Navigateur incompatible.</p>
    </iframe>
    <!-- <script type="text/javascript" language="JavaScript" src="../js/find5.js"></script>	 -->
</body>
</html>	