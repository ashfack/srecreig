<?php
	require("security.php");
	try
	{

		require("../db_connect.php");
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

		//origine
		$origine = $_POST["origine"];

		//type contact
		$typeContact2= $_POST["typeContact2"];

		$commentairesEntreprise= $_POST["commentairesEntreprise"];
		$liste_cycle_id= $_POST["liste_cycle_id"];
		try{
			// Ne devrait pas se faire à la soumission du formulaire mais dynamiquement avec le onblur ou autre
			if($req = $nomEntr->fetch()) 
			{ 
				echo 0;
			}
			else
			{				
				$result=$conn->prepare("INSERT INTO Entreprise(nomEntreprise,groupe,adresse,complementAdresse,codePostal,ville,pays,numeroSIRET,origine,typeContact,commentairesEntreprise) VALUES (upper(?),?,?,?,?,upper(?),?,?,?,?,?)");
				$result->execute(array($nomEntreprise,$groupe,$adresse,$complAdr,$codeP,$ville,$pays,$siret,$origine,$typeContact2,$commentairesEntreprise));
				
				/*verifier si NAF existe dans 
				$result=$conn->prepare("INSERT INTO Entreprise(NAF_codeNaf) VALUES (?)");
				$result->execute(array($codeNAF));
				problème table Naf non rempli*/

				$tab_list_cycle = explode(",",$liste_cycle_id);
				$arr_length=count($tab_list_cycle);
				// Insertion des cycles
				for($i=0;$i<$arr_length;$i++)
				{
					$result=$conn->prepare("INSERT INTO a_Entreprise_CycleFormation(Entreprise_nomEntreprise,CycleFormation_id) VALUES (upper(?),?)");
					$result->execute(array($nomEntreprise,$tab_list_cycle[$i]));	
				}	

				if($nomCP!="")
				{             
					$prenomCP= ucfirst(strtolower($prenomCP));
					$contactP=$conn->prepare("INSERT INTO CoordonneesPersonne (civilite,nom,prenom,fonction,telephoneMobile,telephoneFixe,mail) VALUES (?,upper(?),?,?,?,?,?)");
					$contactP->execute(array($civiliteCP,$nomCP,$prenomCP,$fonctionCP,$telCP_m,$telCP_f,$emailCP));
					$req=$conn->query("Select LAST_INSERT_ID() as res");
					$data=$req->fetch();
					$id_cp=$data['res'];
					$contactP=$conn->prepare("INSERT INTO a_Entreprise_CoordonneesPersonne (Entreprise_nomEntreprise,CoordonneesPersonne_id,type) VALUES (?,?,?)");
					$contactP->execute(array($nomEntreprise,$id_cp,$typecp));
					/*UPDATE CoordonneesPersonne
					SET prenom = INSERT(prenom,1,1,UPPER(SUBSTRING(prenom),1,1)));*/ 
				}
				if($nomCS!="")
				{             
					$prenomCS= ucfirst(strtolower($prenomCS));
					$contactP=$conn->prepare("INSERT INTO CoordonneesPersonne (civilite,nom,prenom,fonction,telephoneMobile,telephoneFixe,mail) VALUES (?,upper(?),?,?,?,?,?)");
					$contactP->execute(array($civiliteCS,$nomCS,$prenomCS,$fonctionCS,$telCS_m,$telCS_f,$emailCS));
					$req=$conn->query("Select LAST_INSERT_ID() as res");
					$data=$req->fetch();
					$id_CS=$data['res'];
					$contactP=$conn->prepare("INSERT INTO a_Entreprise_CoordonneesPersonne (Entreprise_nomEntreprise,CoordonneesPersonne_id,type) VALUES (?,?,?)");
					$contactP->execute(array($nomEntreprise,$id_CS,$typeCS));
				}
				if($nomTA!="")
				{
					$prenomTA=  ucfirst(strtolower($prenomTA));
					$contactP=$conn->prepare("INSERT INTO CoordonneesPersonne (civilite,nom,prenom,fonction,telephoneMobile,telephoneFixe,mail) VALUES (?,upper(?),?,?,?,?,?)");
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