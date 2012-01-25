<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Maklerb&uumlro M&oumlnich</title>
<link rel="stylesheet"
	href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<div class="content">
<form action="" class="form-stacked" method="post">
<fieldset><legend>Neues Objekt</legend>
<div class="clearfix"><label for="rooms">Zimmer​</label>
<div class="input"><input class="xlarge" name="rooms" size="30" type="text">​​​​​​​</div>
</div>
<div class="clearfix"><label for="floors">Etagen</label>
<div class="input"><input class="xlarge" name="floors" size="30" type="text">​​​​​​​</div>
</div>
<div class="clearfix"><label for="postalcode">PLZ</label>
<div class="input"><input class="xlarge" name="postalcode" size="30" type="text">​​​​​​​</div>
</div>
<div class="clearfix">
<label for="status">Status</label>
<div class="input"><select name="status">
<option>Verfuegbar</option>
<option>Reserviert</option>
<option>Verkauft</option>
</select></div></div>


<input style="margin-top: 10px;" class="btn primary" type="submit"
	name="save" value="Speichern" /> <input style="margin-top: 10px;"
	class="btn danger" type="submit" name="delete" value="Löschen" /></fieldset>
</form>

<form action="" method="post"></form>

<?php

require_once 'rb.php';

R::setup('mysql:host=localhost;dbname=makler','root','');

if (isset($_POST['save'])) {
	$new = R::dispense('building');
	$new->rooms = $_POST['rooms'];
	$new->floors = $_POST['floors'];
	$new->postalcode = $_POST['postalcode'];
	$new->status = $_POST['status'];
	R::store($new);

	$builds = R::find('building');
	foreach ($builds as $building) {
		echo($building.'<br>');
	};
}

if (isset($_POST['delete'])) {
	$last = R::findLast('building');
	
	if ($last != NULL) {
		R::trash($last);
	}
	

	$builds = R::find('building');
	foreach ($builds as $building) {
		echo($building.'<br>');
	};
}


?>
</div>

</div>
</body>
</html>
