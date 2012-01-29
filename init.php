<?php

function setup_db() {
	$db = 'mysql';
	$host = 'localhost';
	$db_name = 'makler';
	$user = 'root';
	$pw = '';
	
	R::setup($db.':host='.$host.';dbname='.$db_name, $user, $pw);
}
	
?>