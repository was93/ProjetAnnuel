<?php
	session_start();
	require "conf.inc.php";
	require "functions.php";
	include "header.php";	

?>
	
	<div class="row rowsignup" id="lou">
		<div class="col-md-12">
			<h1>Liste des utilisateurs</h1>




			<?php

				$connection = connectDB();
				// SELECT * FROM users
				$query = $connection->query("SELECT * FROM utilisateur");

				$results = $query->fetchAll();



			?>


			<table class="table">
				<tr>
					<th>ID</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>Anniversaire</th>
					<th>Création</th>
					<th>Modification</th>
					<th>Editer</th>
					<th>Supprimer</th>
				</tr>

				<?php

					foreach ($results as $user) {
						echo "<tr>";
						echo "<td>".$user["id"]."</td>";
						echo "<td>".$user["nom"]."</td>";
						echo "<td>".$user["prenom"]."</td>";
						echo "<td>".$user["email"]."</td>";
						echo "<td>".$user["date_naissance"]."</td>";
						echo "<td>".$user["date_insertion"]."</td>";
						echo "<td>".$user["date_update"]."</td>";
						echo "<td>" ?> <button type="submit" class="btn btn-primary">Editer</button> <?php "</td>";
						echo "<td>" ?> <button type="submit" class="btn btn-primary">Supprimer</button> <?php "</td>";								
						echo "</tr>";
					}

				?>
			</table>

			<div>
				<a href="signup.php">
					<button type="submit" class="btn btn-primary" id="add">Ajouter</button>
				</a>
			</div>


		</div>

	</div>

      
<?php
	include "footer.php";
?>

