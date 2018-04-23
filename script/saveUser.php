<?php
	session_start();

	require "../conf.inc.php";
	require "../functions.php";

	

	// Doit avoir 9 champs
	// Vérifier que les champs: firstname, lastname, ... existent (et non vide)
	if( count($_POST) == 7 
		&& !empty($_POST["prenom"]) 	
		&& !empty($_POST["nom"]) 
		&& !empty($_POST["email"]) 
		&& !empty($_POST["mdp"]) 
		&& !empty($_POST["mdpConfirm"])  
		&& !empty($_POST["date_anniversaire"])
		&& !empty($_POST["cgu"])   
	){

		$error = false;
		$listOfErrors = [];

		//Nettoyage des chaînes
		
		$_POST["prenom"] = ucfirst( strtolower(trim($_POST["prenom"]))) ;
		$_POST["nom"] = strtoupper(trim($_POST["nom"])) ;
		$_POST["email"] = strtolower(trim($_POST["email"])) ;
		$_POST["date_anniversaire"] = trim($_POST["date_anniversaire"]);


		//Vérifier les champs un par un

			//prenom : min 2 max 25
			if( strlen($_POST["prenom"])<2 || strlen($_POST["prenom"])>25  ){
				$error = true;
				$listOfErrors[]=2;
			}
			//nom : min 2 max 125
			if( strlen($_POST["nom"])<2 || strlen($_POST["nom"])>125  ){
				$error = true;
				$listOfErrors[]=3;
			}

			//email : format valide
			if( !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)   ){
				$error = true;
				$listOfErrors[]=4;
			}else{
				//Vérification d'unicité
				//SELECT id FROM users WHERE email="$_POST['email']";
				$connection = connectDB();

				$query = $connection->prepare("SELECT id 
								FROM utilisateur WHERE email=:email");

				$query->execute([
										"email"=>$_POST["email"]
									]);

				//Permet de récupérer toutes les données de ma 
				//requête sql sous forme de tableau
				$results = $query->fetchAll();

				if( !empty($results) ){
					$error = true;	
					$listOfErrors[]=11;
				}

			}
			
			//date_anniversaire : a faire ensemble
			//2017-02-01 ou 01/02/2017
			//yyyy-mm-dd ou dd/mm/yyyy

			$dateFormat = false;

			if(  strpos( $_POST["date_anniversaire"] , "/")  ){
				list($day,$month,$year) = explode("/", $_POST["date_anniversaire"] );
				$dateFormat = true;
			}else if( strpos( $_POST["date_anniversaire"] , "-")  ){
				list($year,$month,$day) = explode("-", $_POST["date_anniversaire"] );
				$dateFormat = true;
			}else{
				$error = true;
				$listOfErrors[]=5;
			}

			// -> explode : permet de couper une chaîne
			//est ce que la date est valide : exemple 30/02/2017
			// -> bool checkdate ( int $month , int $day , int $year )
			if($dateFormat){
				if( is_numeric($month) 
				&& is_numeric($day)
				&& is_numeric($year)
				&& checkdate ( $month , $day , $year ) ){

					//Vérifier que l'internaute a entre 18 et 100 ans
					//echo time();
					$today = time();
					$date_anniversaire = mktime(0,0,0,$month,$day,$year);
					$time18years = $today - 18*3600*24*365;
					$time100years = $today - 100*3600*24*365;

					if( $date_anniversaire > $time18years || $date_anniversaire < $time100years){
						$error = true;
						$listOfErrors[]=6;
					}
				}else{
					$error = true;
					$listOfErrors[]=7;
				}
			}

			


			//mdp : min 8 max 25
			if( strlen($_POST["mdp"])<8 || strlen($_POST["mdp"])>25  ){
				$error = true;
				$listOfErrors[]=9;
			}
			//pwdConfirm == mdp
			if($_POST["mdp"] != $_POST["mdpConfirm"]){
				$error = true;
				$listOfErrors[]=10;
			}
			

			//cgu : Pas besoin de la tester car s'elle n'est pas cochée elle n'existe pas




			if($error){
				// redirection (signup.php) avec les erreurs
				//echo "error";
				$_SESSION["errorsForm"] = $listOfErrors;
				$_SESSION["postForm"] = $_POST;
				header("Location: ../signup.php");


			}else{
				//Si ok : insertion en BDD et redirection (index.php) avec message success

				
				
				$query = $connection->prepare("INSERT INTO utilisateur (prenom,nom,date_naissance,email,mdp)
					VALUES ( :titi, :tutu, :toutou, :toto, :tata  ) ");				


				$query->execute([
									
									"titi"=>$_POST["prenom"],
									"tutu"=>$_POST["nom"],
									"toutou"=>$year."-".$month."-".$day,
									"toto"=>$_POST["email"],
									"tata"=>password_hash($_POST["mdp"], PASSWORD_DEFAULT)
								]);
								
				header("Location: ../index.php");
			}

		

	}else{

		die("Tentative de Hack");

	}