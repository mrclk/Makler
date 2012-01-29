<?php

require 'include.php';

setup_db();

if (isset($_POST['save'])) {

	$location = R::dispense('location');
	$location->forename = $_POST['forename'];
	$location->name = $_POST['name'];
	$location->str = $_POST['str'];
	$location->strnr = $_POST['strnr'];
	$location->postalcode = $_POST['postalcode'];
	$location->city = $_POST['city'];
	$location->phone = $_POST['phone'];

	if (isset($_POST['eqowner'])) {
		$eqowner = $_POST['eqowner'];
	} else {
		$eqowner = 'n';
	}

	$location->eqowner = $eqowner;

	$owner = R::dispense('owner');
	if ($eqowner != 'y') {
		$owner->forename = $_POST['owner-forename'];
		$owner->name = $_POST['owner-name'];
		$owner->str = $_POST['owner-str'];
		$owner->strnr = $_POST['owner-strnr'];
		$owner->postalcode = $_POST['owner-postalcode'];
		$owner->city = $_POST['owner-city'];
		$owner->phone = $_POST['owner-phone'];
	}

	$building = R::dispense('building');
	$building->rooms = $_POST['rooms'];
	$building->floors = $_POST['floors'];
	$building->qm = $_POST['qm'];
	$building->price = $_POST['price'];
	$building->minprice = $_POST['minprice'];
	$building->status = $_POST['status'];
	$building->location = $location;
	$building->owner = $owner;


	$id = R::store($building);

	header( "refresh:1;url=details.php?id=".$id );

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Maklerb&uuml;ro M&ouml;nich</title>
<link rel="stylesheet"
	href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/animations.js"></script>
</head>
<body>
<img src="img/logo.png">
<div class="content">
<h1>Neues Objekt</h1>
<form action="" class="form-stacked" method="post">
<div style="display: inline-block;">
<fieldset class="fields fleft">
<h3>Eigenschaften</h3>
<div class="clearfix"><label for="rooms">Zimmer</label>
<div class="input"><input class="span2" name="rooms" maxlength="3"
	type="text"></div>
</div>
<div class="clearfix"><label for="floors">Etagen</label>
<div class="input"><input class="span2" name="floors" maxlength="3"
	type="text"></div>
</div>
<div class="clearfix"><label for="qm">Fl&auml;che (m&sup2;)</label>
<div class="input"><input class="span2" name="qm" maxlength="5"
	type="text"></div>
</div>
<div class="clearfix"><label for="price">Preis (&euro;)</label>
<div class="input"><input class="span2" name="price" maxlength="9"
	type="text"></div>
</div>
<div class="clearfix"><label for="minprice">Min. Preis (&euro;)</label>
<div class="input"><input class="span2" name="minprice" maxlength="9"
	type="text"></div>
</div>
<div class="clearfix"><label for="status">Status</label>
<div class="input"><select class="span2" name="status">
	<option>Verfuegbar</option>
	<option>Reserviert</option>
	<option>Verkauft</option>
</select></div>
</div>
</fieldset>
<fieldset class="fields fleft left-dashed">
<h3>Ortsangaben</h3>
<div class="clearfix"><label for="forename">Vorname</label>
<div class="input"><input class="span3" name="forename" maxlength="40"
	type="text"></div>
</div>
<div class="clearfix"><label for="name">Nachname</label>
<div class="input"><input class="span3" name="name" maxlength="30"
	type="text"></div>
</div>
<div class="clearfix"><label for="str">Strasse</label>
<div class="input"><input class="span3" name="str" maxlength="50"
	type="text"></div>
</div>
<div class="clearfix"><label for="strnr">Hausnummer</label>
<div class="input"><input class="span2" name="strnr" maxlength="4"
	type="text"></div>
</div>
<div class="clearfix"><label for="postalcode">PLZ</label>
<div class="input"><input class="span2" name="postalcode" maxlength="5"
	type="text"></div>
</div>
<div class="clearfix"><label for="city">Stadt</label>
<div class="input"><input class="span3" name="city" maxlength="30"
	type="text"></div>
</div>
<div class="clearfix"><label for="phone">Telefon</label>
<div class="input"><input class="span3" name="phone" maxlength="30"
	type="text"></div>
</div>
<div class="clearfix"><label for="eqowner">Besitzer</label>
<div class="input"><input type="checkbox" id="eqowner" name="eqowner"
	value="y"> <span>Besitzerangaben sind identisch</span></div>
</div>
</fieldset>
<fieldset id="owner" class="fields fleft left-dashed">
<h3>Besitzerangaben</h3>
<div class="clearfix"><label for="owner-forename">Vorname</label>
<div class="input"><input class="span3" name="owner-forename"
	maxlength="40" type="text"></div>
</div>
<div class="clearfix"><label for="owner-name">Nachname</label>
<div class="input"><input class="span3" name="owner-name" maxlength="30"
	type="text"></div>
</div>
<div class="clearfix"><label for="owner-str">Strasse</label>
<div class="input"><input class="span3" name="owner-str" maxlength="50"
	type="text"></div>
</div>
<div class="clearfix"><label for="owner-strnr">Hausnummer</label>
<div class="input"><input class="span2" name="owner-strnr" maxlength="4"
	type="text"></div>
</div>
<div class="clearfix"><label for="owner-postalcode">PLZ</label>
<div class="input"><input class="span2" name="owner-postalcode"
	maxlength="5" type="text"></div>
</div>
<div class="clearfix"><label for="owner-city">Stadt</label>
<div class="input"><input class="span3" name="owner-city" maxlength="30"
	type="text"></div>
</div>
<div class="clearfix"><label for="owner-phone">Telefon</label>
<div class="input"><input class="span3" name="owner-phone"
	maxlength="30" type="text"></div>
</div>
</fieldset>
</div>

<div class="actions"><input class="btn primary" type="submit"
	name="save" value="Speichern" /> <a href="index.php" class="btn">Zur&uuml;ck</a></div>

</form>
<?php
if (isset($_POST['save'])) {
	$builds = R::find('building');
	foreach ($builds as $building) {
		echo('<div class="alert-message success" style="width: 800px"><p>'.$building.'</p></div>');
	}};?></div>

</body>
</html>
