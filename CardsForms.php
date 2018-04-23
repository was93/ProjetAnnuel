<?php  
	session_start();
	require "functions.php";
	require "conf.inc.php";
	include "header.php";
?>

	<div class="row rowsignup" id="lou">
		<div class="col-md-12">
			<h1>Ajouter une carte</h1>


	 <center id="carte">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-6">	                	                    
	                    <div class="panel-body">
	                        <form  method="POST" action="script/saveCard.php" enctype="multipart/form-data">
	                            <fieldset>
	                                <div class="form-group">
	                                    <input class="form-control" placeholder="Nom Carte" name="nom" type="text" autofocus 
	                                    value="<?php
										      	echo (isset($_SESSION["postForm"]["nom"]))?
										      	$_SESSION["postForm"]["nom"]
										      	:"";
										      ?>">
	                                </div>

	                                <div class="form-group">
	                                    <input class="form-control" placeholder="Spécialité" name="specialite" type="text" value="<?php
										      	echo (isset($_SESSION["postForm"]["specialite"]))?
										      	$_SESSION["postForm"]["specialite"]
										      	:"";
										      ?>">
	                                </div>

	                                <div class="form-group">
	                                    <input class="form-control" placeholder="Description" name="description" type="text" value="<?php
										      	echo (isset($_SESSION["postForm"]["description"]))?
										      	$_SESSION["postForm"]["description"]
										      	:"";
										      ?>">
	                                </div>

	                                <div class="form-group">
	                                	<input type="hidden" name="MAX_FILE_SIZE" value="10240">
	                                	<input type="file" name="image" value="<?php
										      	echo (isset($_SESSION["postForm"]["image"]))?
										      	$_SESSION["postForm"]["image"]
										      	:"";
										      ?>">
	                                </div>

	                                <div class="form-group">
				  						<label class="form-check-label">			    
					    					<input type="checkbox" class="form-check-input" name="online">
					   						Mettre en ligne
										</label>
				  					</div>

	                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Valider">
	                            </fieldset>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</center>

	<?php 
			//supprime les valeurs du formulaire
			unset($_SESSION["cards"]);
	?>

<?php
 require "footer.php";
?>
