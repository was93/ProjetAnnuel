<?php 

header("Content-Type: image/png");

$image = imagecreate(200,50);

$white = imagecolorallocate($image, 255, 255, 255);
$green = imagecolorallocate($image, 0, 255, 0);
$red = imagecolorallocate($image, 255, 0, 0);


$charAuthorized = "abcdefghijklmnopqrstuvwxyz1234567890";
$charAuthorized = str_shuffle($charAuthorized);
$captcha = substr($charAuthorized, 0, rand(4,6));

imagestring (  $image , 5 , 10 , 10 , $captcha , $red);

imageline($image, 0, 0, 100, 50, $red);

imagepng($image);


/*

	Modifier la police d'écriture aléatoire (parmis une liste) par caractère
	Positionnement et inclinaison aléatoires par lettre
	lettre et chiffre aléatoires
	couleur aléatoire par lettre
	générer aléatoirement des formes géométriques (ligne, carré, rond, ....) de couleurs aléatoires par dessus
	Visible et lisible
	
*/





