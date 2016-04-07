<?php
    session_start();
	
    if (! isset($_SESSION['id']))
    {
        echo 'Session expir�e, veuillez vous reconnecter !';
        echo "Cliquez <a href=\"index.php\">ici</a>"; 
        exit();
    } 
	try
	{
		
		include("db_connect.php");
	
		
		//Entreprise
		
		$nomEntreprise = $_POST["nomEntreprise"];
		$groupe = $_POST["groupe"];
		$codeNAF = $_POST["codeNAF"];
		$siret = $_POST["siret"];
		$adresse = $_POST["adresse"];
		$complAdr = $_POST["complAdr"];
		$codeP = $_POST["codeP"];
		$ville = $_POST["ville"];
		$pays = $_POST["pays"];
		$nomEntr = $conn->query("SELECT * FROM Entreprise WHERE nomEntreprise='$nomEntreprise'");
		
		//Contact pimaire
		
		$nomCP = $_POST["nomCP"];
		$prenomCP = $_POST["prenomCP"];
		$fonctionCP = $_POST["fonctionCP"];
		$telCP = $_POST["telCP"];
		$emailCP = $_POST["emailCP"];
		
		$civiliteCP=$_POST['civiliteCP'];
		$typecp="Primaire";
		
		try{
			if($req = $nomEntr->fetch()) { 
				
				echo 0;
			}
			else{
				
		$result=$conn->prepare("INSERT INTO Entreprise(nomEntreprise,groupe,adresse,complementAdresse,codePostal,ville,pays,numeroSIRET) VALUES (?,?,?,?,?,?,?,?)");
		$result->execute(array($nomEntreprise,$groupe,$adresse,$complAdr,$codeP,$ville,$pays,$siret));
		/*verifier si NAF existe dans 
		$result=$conn->prepare("INSERT INTO Entreprise(NAF_codeNaf) VALUES (?)");
		$result->execute(array($codeNAF));
		probl�me table Naf non rempli*/		
		if($nomCP!="")
		{
			$contactP=$conn->prepare("INSERT INTO CoordonneesPersonne (civilite,nom,prenom,fonction,telephoneMobile,mail) VALUES (?,?,?,?,?,?)");
			$contactP->execute(array($civiliteCP,$nomCP,$prenomCP,$fonctionCP,$telCP,$emailCP));
			$req=$conn->query("Select LAST_INSERT_ID() as res");
			$data=$req->fetch();
			$id_cp=$data['res'];
			$contactP=$conn->prepare("INSERT INTO a_Entreprise_CoordonneesPersonne (Entreprise_nomEntreprise,CoordonneesPersonne_id,type) VALUES (?,?,?)");
			$contactP->execute(array($nomEntreprise,$id_cp,$typecp));
		}
		
		echo 1;
		 
		}
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	catch(Exception $e)
	{
		//echo "�chec : " . $e->getMessage();
	}
?>