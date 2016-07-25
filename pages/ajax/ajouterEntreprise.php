<?php
	header('Content-Type: text/html; charset=utf-8'); 
	require("security.php");
	try
	{

		require("../db_connect.php");
		//Entreprise
		$nomEntreprise = $_POST["nomEntreprise"];
		$groupe = $_POST["groupe"];
		$libelleNAF = $_POST["libelleNAF"];
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
		$correspondance_origine=array("sre"=>"SRE",
                                 "aisg"=>"AISG",
                                 "aimg"=>"AMIG",
                                 "cavam"=>"CAVAM",
                                 "cedip"=>"CEDIP",
                                 "corpsPeda"=>"Corps Pédagogique",
                                 "dig"=>"Direction Institut Galilée",
                                 "dsg"=>"Direction Sup Galilée",
                                 "estEns"=>"Est Ensemble",
                                 "mecig"=>"Membre exterieur Conseil Institu Galilée",
                                 "meCAsg"=>"Membre exterieur CA Sup Galilée",
                                 "pc"=>"Plaine Commune",
                                 "presidence"=>"Présidence",
                                 "rp"=>"Responsable pédagogique",
                               	"scuio"=>"SCUIO-IP");

		//type contact
		$typeContact= $_POST["typeContact"];
		$correspondance_typeContact=array("entreprise"=>"Entreprise","personne"=>"Personne","ct"=>"Collectivité territoriale","ca"=>"Communauté d'agglomérations");

		$commentairesEntreprise= $_POST["commentairesEntreprise"];
		$liste_cycle_id= $_POST["liste_cycle_id"];
		$actions=$_POST["actions"];
		try{
			// Ne devrait pas se faire à la soumission du formulaire mais dynamiquement avec le onblur ou autre
			if($req = $nomEntr->fetch()) 
			{ 
				echo 0;
			}
			else
			{
				if($libelleNAF=="NULL")
					$libelleNAF=null;
				if($origine!="null")
					$origine=$correspondance_origine[$origine];
				if($typeContact!="null")
					$typeContact=$correspondance_typeContact[$typeContact];

				$result=$conn->prepare("INSERT INTO Entreprise(nomEntreprise,groupe,adresse,complementAdresse,codePostal,ville,pays,numeroSIRET,NAF_codeNAF,origine,typeContact,commentairesEntreprise) VALUES (upper(?),?,?,?,?,upper(?),?,?,?,?,?,?)");
				$result->execute(array($nomEntreprise,$groupe,$adresse,$complAdr,$codeP,$ville,$pays,$siret,$libelleNAF,$origine,$typeContact,$commentairesEntreprise));
				
				$tab_list_cycle = explode(",",$liste_cycle_id);
				$arr_length=count($tab_list_cycle);
				// Insertion des cycles
				for($i=0;$i<$arr_length;$i++)
				{
					$result=$conn->prepare("INSERT INTO a_Entreprise_CycleFormation(Entreprise_nomEntreprise,CycleFormation_id) VALUES (upper(?),?)");
					$result->execute(array($nomEntreprise,$tab_list_cycle[$i]));	
				}

				//insertion des actions
				if($actions!="")
				{
					$tab_actions = explode(",",$actions);
					$actions_length=count($tab_actions);
				}
				else
					$actions_length=0;
			
				for($i=0;$i<$actions_length;$i++)
				{
					$result=$conn->prepare("INSERT INTO a_Entreprise_Action(Entreprise_nomEntreprise,Action_id) VALUES (upper(?),?)");
					$result->execute(array($nomEntreprise,$tab_actions[$i]));	
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