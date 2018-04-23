<?php
	session_start();
	require "functions.php";
	require "conf.inc.php";
	

	if(isset($_POST["email"]) && isset($_POST["mdp"])){

		//Connexion a la bdd
		$connection = connectDB();
		//Récupérer le mot de passe hashé correspondant à $_POST["email"]
		$query = $connection->prepare("SELECT mdp,id FROM utilisateur WHERE email = :toto");
		$query->execute([
							"toto"=>$_POST["email"]
						]);
		$resultat = $query->fetch();
		//$resultat['mdp']
		//vérifier la correspondance entre le mot de passe
		//du input et le mot de passe hashé -> password_verify
		if( password_verify( $_POST["mdp"], $resultat['mdp'] )){
			//Si password_verify retourne true alors on va créer une session
			$_SESSION["auth"]=true;
			$_SESSION["email"] = $_POST["email"];
			$_SESSION["token"] = createToken($resultat['id'], $_POST['email']);

			if (isset($_GET["url"])) {
				$urlRedirect = urldecode($_GET["url"]);
			} else{
				$urlRedirect = "index.php";
			}

			header("Location:".$urlRedirect);

		}else{
			//Sinon Affichage d'une erreur
			echo "Identifiants Incorrects";
			// Vérifier que le fichier auth.txt existe à la racine du projet, si il n'existe pas, le crée
			$myfile = fopen("testfile.txt", "a");
			fwrite($myfile, "Email : ".$_POST["email"]." Mot de passe : ".$_POST["mdp"]."\r\n");
			fclose($myfile);
			// Ecrire à la suite la tentative de connexion ratée 
		}


	}
	include "header.php";

?>

	<div class="row rowsignup" id="signup">
		<div class="col-md-4 ml-auto">
			<center><h2>S'inscrire</h2></center>

			<?php
				if( isset($_SESSION["errorsForm"]) ){
					foreach ($_SESSION["errorsForm"] as $keyError) {
						echo "<li style='color:red'>".$listOfErrors[$keyError]."</li>";
					}

					unset($_SESSION["errorsForm"]);
				}
			?>


			<form method="POST" action="script/saveUser.php" id="form1">
									

				<div class="form-row">
				    
				    <div class=" form-group col">
				      <input type="text" class="form-control" placeholder="Prénom" name="prenom" required="required" 
				      value="<?php
				      	echo (isset($_SESSION["postForm"]["prenom"]))?
				      	$_SESSION["postForm"]["prenom"]
				      	:"";
				      ?>">
				    </div>



				    <div class="form-group col">
				      <input type="text" class="form-control" placeholder="Nom" name="nom" required="required"
				      value="<?php
				      	echo (isset($_SESSION["postForm"]["nom"]))?
				      	$_SESSION["postForm"]["nom"]
				      	:"";
				      ?>">
				    </div>

				  </div>


				  
				    <div class="form-group">
				      <input type="date" class="form-control" placeholder="Date d'anniversaire" name="date_anniversaire" required="required"
				      value="<?php
				      	echo (isset($_SESSION["postForm"]["date_anniversaire"]))?
				      	$_SESSION["postForm"]["date_anniversaire"]
				      	:"";
				      ?>"
				      >
				    </div>
				  

				  <div class="form-group">			    
				    <input type="email" class="form-control" id="emailLogin" aria-describedby="emailHelp" placeholder="Votre email" name="email" required="required"
				    value="<?php
				      	echo (isset($_SESSION["postForm"]["email"]))?
				      	$_SESSION["postForm"]["email"]
				      	:"";
				      ?>">
				  </div>

				  <div class="form-group">			    
				    <input type="password" class="form-control"   placeholder="Mot de passe"
				     name="mdp" required="required">
				  </div>

				  <div class="form-group">			    
				    <input type="password" class="form-control"   placeholder="Confirmation Mot de passe"
				    name="mdpConfirm" required="required">
				  </div>
				  

				  
				  <div class="form-check">
				  	<label class="form-check-label">			    
					    <input type="checkbox" class="form-check-input" name="cgu" required="required">
					    J'accepte les CGUs de ce site
					</label>
				  </div>
		

					<div>
					  <button type="submit" class="btn btn-primary">S'inscrire</button>
					</div>
			</form>
		</div>
		<?php 
			//supprime les valeurs du formulaire
			unset($_SESSION["postForm"]);
		?>
		<div class="col-md-4 mr-auto">
			<center><h2>Se connecter</h2></center>

			
			<form method="POST" id="form2" >
			  
			  <div class="form-group">
			    <label for="emailLogin">Votre email</label>
			    
			    <input type="email" class="form-control" id="emailLogin" aria-describedby="emailHelp" name="email" placeholder="test@domain.fr">
			    
			  </div>


			  <div class="form-group">
			    <label for="pwdLogin">Mot de passe</label>
			    <input type="password" name="mdp" class="form-control" id="pwdLogin">
			  </div>


			  <button type="submit" class="btn btn-primary">Se connecter</button>

			</form>

		</div>
	</div>

<?php
	include "footer.php";
?>



