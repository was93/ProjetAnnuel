<?php

define("DBDRIVER", "mysql");
define("DBHOST", "localhost");
define("DBNAME", "projet_annuel");
define("DBUSER", "root");
define("DBPWD", "");


$listOfErrors=[
	1=>"L'image est trop grande",
	2=>"Le prénom doit faire plus de 2 caractères",
	3=>"Le nom doit faire plus de 2 caractères",
	4=>"L'email n'est pas valide",
	5=>"Le format de la date d'anniversaire n'est pas correct",
	7=>"La date d'anniversaire n'existe pas",
	6=>"Vous devez avoir entre 18 et 100 ans",
	8=>"La spécialité doit faire entre 2 et 50 caractères",
	9=>"Le mot de passe doit faire entre 8 et 20 caractères",
	10=>"Le mot de passe de confirmation ne correspond pas",
	11=>"L'email existe déjà",
];





