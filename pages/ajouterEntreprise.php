<?php
    session_start();
	
    if (! isset($_SESSION['id']))
    {
        echo 'Session expirée, veuillez vous reconnecter !';
        echo "Cliquez <a href=\"index.php\">ici</a>"; 
        exit();
    } 
	try
	{
		
		include("db_connect.php");
	
	
		
		$nomEntreprise = $_POST["nomEntreprise"];
		$groupe = $_POST["groupe"];
		$codeNAF = $_POST["codeNAF"];
		$siret = $_POST["siret"];
		$adresse = $_POST["adresse"];
		$complAdr = $_POST["complAdr"];
		$codeP = $_POST["codeP"];
		$ville = $_POST["ville"];
		$pays = $_POST["pays"];
		
		
		
		
		$result=$conn->prepare("INSERT INTO Entreprise(nomEntreprise,groupe,adresse,complementAdresse,codePostal,ville,pays,numeroSIRET) VALUES (?,?,?,?,?,?,?,?)");
		try{
		$result->execute(array($nomEntreprise,$groupe,$adresse,$complAdr,$codeP,$ville,$pays,$siret));
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	catch(Exception $e)
	{
		//echo "Échec : " . $e->getMessage();
	}
?>