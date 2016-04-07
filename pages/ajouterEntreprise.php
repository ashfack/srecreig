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
		
		//Contact primaire
		
		$nomCP = $_POST["nomCP"];
		$prenomCP = $_POST["prenomCP"];
		$fonctionCP = $_POST["fonctionCP"];
		$telCP_m = $_POST["telCP_m"];
		$telCP_f = $_POST["telCP_f"];
		
		$emailCP = $_POST["emailCP"];
		$civiliteCP=$_POST['civiliteCP'];
		$typecp="Primaire";
		
		//Contact secondaire
		
		$nomCS = $_POST["nomCS"];
		$prenomCS = $_POST["prenomCS"];
		$fonctionCS = $_POST["fonctionCS"];
		$telCS_f = $_POST["telCS_f"];
		$telCS_m = $_POST["telCS_m"];
		$emailCS = $_POST["emailCS"];
		$civiliteCS=$_POST['civiliteCS'];
		$typeCS="Secondaire";
		
		//Contact TA
		
		$nomTA = $_POST["nomTA"];
		$prenomTA = $_POST["prenomTA"];
		$fonctionTA = $_POST["fonctionTA"];
		$telTA_f = $_POST["telTA_f"];
		$telTA_m = $_POST["telTA_m"];
		$emailTA = $_POST["emailTA"];
		$civiliteTA=$_POST['civiliteTA'];
		$typeTA="TA";
		
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
		probléme table Naf non rempli*/		
		if($nomCP!="")
		{
			$contactP=$conn->prepare("INSERT INTO CoordonneesPersonne (civilite,nom,prenom,fonction,telephoneMobile,telephoneFixe,mail) VALUES (?,?,?,?,?,?,?)");
			$contactP->execute(array($civiliteCP,$nomCP,$prenomCP,$fonctionCP,$telCP_m,$telCP_f,$emailCP));
			$req=$conn->query("Select LAST_INSERT_ID() as res");
			$data=$req->fetch();
			$id_cp=$data['res'];
			$contactP=$conn->prepare("INSERT INTO a_Entreprise_CoordonneesPersonne (Entreprise_nomEntreprise,CoordonneesPersonne_id,type) VALUES (?,?,?)");
			$contactP->execute(array($nomEntreprise,$id_cp,$typecp));
		}
		if($nomCS!="")
		{
			$contactP=$conn->prepare("INSERT INTO CoordonneesPersonne (civilite,nom,prenom,fonction,telephoneMobile,telephoneFixe,mail) VALUES (?,?,?,?,?,?,?)");
			$contactP->execute(array($civiliteCS,$nomCS,$prenomCS,$fonctionCS,$telCS_m,$telCS_f,$emailCS));
			$req=$conn->query("Select LAST_INSERT_ID() as res");
			$data=$req->fetch();
			$id_CS=$data['res'];
			$contactP=$conn->prepare("INSERT INTO a_Entreprise_CoordonneesPersonne (Entreprise_nomEntreprise,CoordonneesPersonne_id,type) VALUES (?,?,?)");
			$contactP->execute(array($nomEntreprise,$id_CS,$typeCS));
		}
		
		if($nomTA!="")
		{
			$contactP=$conn->prepare("INSERT INTO CoordonneesPersonne (civilite,nom,prenom,fonction,telephoneMobile,telephoneFixe,mail) VALUES (?,?,?,?,?,?,?)");
			$contactP->execute(array($civiliteTA,$nomTA,$prenomTA,$fonctionTA,$telTA_m,$telTA_f,$emailTA));
			$req=$conn->query("Select LAST_INSERT_ID() as res");
			$data=$req->fetch();
			$id_TA=$data['res'];
			$contactP=$conn->prepare("INSERT INTO a_Entreprise_CoordonneesPersonne (Entreprise_nomEntreprise,CoordonneesPersonne_id,type) VALUES (?,?,?)");
			$contactP->execute(array($nomEntreprise,$id_TA,$typeTA));
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
		//echo "Échec : " . $e->getMessage();
	}
?>