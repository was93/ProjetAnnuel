<?php
	session_start();
	require "conf.inc.php";
	require "functions.php";
	

	include "header.php";

?>
	
	<div class="row rowsignup" id="loc">
		<div class="col-md-12">
			<h1>Liste des Cartes</h1>


			<?php

				$connection = connectDB();
				// SELECT * FROM users
				$query = $connection->query("SELECT * FROM carte WHERE online = 1");

				$results = $query->fetchAll();



			?>


			<table class="table">
				<tr>
					<th>Formule</th>
					<th>Spécialité</th>
					<th>Image</th>
					<th>Description</th>
				</tr>

				<?php

					foreach ($results as $user) {
						echo "<tr>";
						echo "<td>".$user["nom"]."</td>";
						echo "<td>".$user["specialite"]."</td>";
						echo "<td>".$user["image"]."</td>";
						echo "<td>".$user["description"]."</td>";	
						echo "</tr>";
					}

				?>
			</table>

			<div>
				<a href="CardsForms.php">
					<button type="submit" class="btn btn-primary" id="add">Ajouter</button>
				</a>
			</div>

		</div>

	</div>

      
<?php
	include "footer.php";
?>
