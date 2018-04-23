<?php
	session_start();

	require "../conf.inc.php";
	require "../functions.php";

	

	// Doit avoir 4 champs obligatoire
	// Vérifier que les champs existent
	if( count($_POST) == 4 
		&& !empty($_POST["nom"]) 	
		&& !empty($_POST["specialite"]) 
		&& !empty($_POST["description"]) 
		&& !empty($_POST["image"])    
	){

		$error = false;
		$listOfErrors = [];

		//Nettoyage des chaînes
		
		$_POST["nom"] = ucfirst( strtolower(trim($_POST["nom"]))) ;
		$_POST["specialite"] = ucfirst( strtolower(trim($_POST["specialite"]))) ;


		//Vérifier les champs un par un

			//nom : min 2 max 125
			if( strlen($_POST["nom"])<2 || strlen($_POST["nom"])>125  ){
				$error = true;
				$listOfErrors[]=3;
			}

			if( strlen($_POST["specialite"])<2 || strlen($_POST["specialite"])>50  ){
				$error = true;
				$listOfErrors[]=8;
			}
			
			if($_POST["image"] > 10240){
				$error = true;
				$listOfErrors[]=10;
			}
			
			if($error){
				// redirection (listOfCards.php) avec les erreurs
				//echo "error";
				$_SESSION["errorsForm"] = $listOfErrors;
				$_SESSION["cards"] = $_POST;
				header("Location: ../listOfCards.php");


			}else{
				//Si ok : insertion en BDD et redirection (index.php) avec message success

				$connection = connectDB();
				
				$query = $connection->prepare("INSERT INTO carte (nom,specialite,image,description)
					VALUES ( :titi, :tutu, :toutou, :toto ) ");				


				$query->execute([
									
									"titi"=>$_POST["nom"],
									"tutu"=>$_POST["specialite"],
									"toutou"=>$_POST["image"],
									"toto"=>$_POST["description"],
								]);
								
				header("Location: ../listOfCards.php");
			}

		

	}else{

		die("Tentative de Hack");

	}