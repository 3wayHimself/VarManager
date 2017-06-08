<?php
/**
 * VarManager - Version 1.0
 *
 * Inspired to Variable Managment in JSON.
 *
 *
 * @author Alemalakra
 */


require('varmanager.php');
$VarManager = new VarManager();


$VarManager->encryptAll(); // Recommended

$VarManager->set('Testing', 'Testing? Of Course.');


if ($VarManager->is_set('Testing')) {
	echo $VarManager->get('Testing');
} else {
	echo "Variable not Set!";
}

?>