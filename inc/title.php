<?php

switch (basename($_SERVER['SCRIPT_NAME'])) {
	case 'index.php':
		echo "Tyler's CSCI 100 Home Page";
		break;

	case 'about.php':
		echo "About Tyler";
		break;
	
	case 'contact.php':
		echo "Contact Tyler";
		break;

	case 'classes.php':
		echo "Classes Tyler Teaches";
		break;

	default:
		echo "Undefined";
		break;
}

 ?>