<?php

function connectDB(){

	try{
		$connection = new PDO(
					DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,
					DBUSER,
					DBPWD
						);
	}catch(Exception $e){
		die( "Erreur SQL ".$e->getMessage() );
	}

	return $connection;

}


function createToken($id, $email){

	$sha1 = sha1($email."FDSQfdsq444FGSDQ".$id."fdsfqfsdq");
	return substr($sha1, 4, 10) ;
}


function isConnected(){

	if(isset($_SESSION["auth"]) && $_SESSION["auth"]==true){

		$connection = connectDB();
		
		$query = $connection->prepare("SELECT id FROM utilisateur WHERE email = :toto");
		$query->execute([
						"toto"=>$_SESSION["email"]
					]);
		$resultat = $query->fetch();

		if($_SESSION["token"] == createToken($resultat["id"], $_SESSION["email"]) ){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}

}

function admin(){

	if(isset($_SESSION["auth"]) && $_SESSION["auth"]==true){

		$connection = connectDB();
		
		$query = $connection->prepare("SELECT id FROM utilisateur WHERE email = :toto AND admin = 1");
		$query->execute([
						"toto"=>$_SESSION["email"]
					]);
		$resultat = $query->fetch();

		if($_SESSION["token"] == createToken($resultat["id"], $_SESSION["email"]) ){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}

}

function isPrivate(){
	if (!isConnected()) {
		header("Location: signup.php?url=".urlencode($_SERVER["REQUEST_URI"]));
	}
}












