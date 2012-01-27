<?php
require 'include.php';
R::setup('mysql:host=localhost;dbname=makler','root','');

if (isset($_GET['id'])) {
	$building = R::load('building', $_GET['id']);
	if ($building->id != 0) {
		$location = R::load('location', $building->location_id);
		$owner = R::load('owner', $building->owner_id);
	}
}

if (isset($_POST['save'])) {

	$location = R::load('location', $building->location_id);
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

	$owner = R::load('owner', $building->owner_id);
	if ($eqowner != 'y') {
		$owner->forename = $_POST['owner-forename'];
		$owner->name = $_POST['owner-name'];
		$owner->str = $_POST['owner-str'];
		$owner->strnr = $_POST['owner-strnr'];
		$owner->postalcode = $_POST['owner-postalcode'];
		$owner->city = $_POST['owner-city'];
		$owner->phone = $_POST['owner-phone'];
	}

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
</head>
<body>
<div class="content">
<h1>Objekt bearbeiten <small>#<?php echo $building->id;?></small></h1>
<form action="" class="form-stacked" method="post">
<div style="display: inline-block;">
<fieldset class="fields fleft">
<h3>Eigenschaften</h3>
<div class="clearfix"><label for="rooms">Zimmer</label>
<div class="input"><input class="span2" name="rooms" maxlength="3"
	type="text" value="<?php echo $building->rooms;?>"></div>
</div>
<div class="clearfix"><label for="floors">Etagen</label>
<div class="input"><input class="span2" name="floors" maxlength="3"
	type="text" value="<?php echo $building->floors;?>"></div>
</div>
<div class="clearfix"><label for="qm">Fl&auml;che (m&sup2;)</label>
<div class="input"><input class="span2" name="qm" maxlength="5"
	type="text" value="<?php echo $building->qm;?>"></div>
</div>
<div class="clearfix"><label for="price">Preis (&euro;)</label>
<div class="input"><input class="span2" name="price" maxlength="9"
	type="text" value="<?php echo $building->price;?>"></div>
</div>
<div class="clearfix"><label for="minprice">Min. Preis (&euro;)</label>
<div class="input"><input class="span2" name="minprice" maxlength="9"
	type="text" value="<?php echo $building->minprice;?>"></div>
</div>
<div class="clearfix"><label for="status">Status</label>
<div class="input"><select class="span2" name="status">
	<option <?php if ($building->status == 'Verfuegbar') echo 'selected'?>>Verfuegbar</option>
	<option <?php if ($building->status == 'Reserviert') echo 'selected'?>>Reserviert</option>
	<option <?php if ($building->status == 'Verkauft') echo 'selected'?>>Verkauft</option>
</select></div>
</div>
</fieldset>
<fieldset class="fields fleft left-dashed">
<h3>Ortsangaben</h3>
<div class="clearfix"><label for="forename">Vorname</label>
<div class="input"><input class="span3" name="forename" maxlength="40"
	type="text" value="<?php echo $location->forename;?>"></div>
</div>
<div class="clearfix"><label for="name">Nachname</label>
<div class="input"><input class="span3" name="name" maxlength="30"
	type="text" value="<?php echo $location->name;?>"></div>
</div>
<div class="clearfix"><label for="str">Strasse</label>
<div class="input"><input class="span3" name="str" maxlength="50"
	type="text" value="<?php echo $location->str;?>"></div>
</div>
<div class="clearfix"><label for="strnr">Hausnummer</label>
<div class="input"><input class="span2" name="strnr" maxlength="4"
	type="text" value="<?php echo $location->strnr;?>"></div>
</div>
<div class="clearfix"><label for="postalcode">PLZ</label>
<div class="input"><input class="span2" name="postalcode" maxlength="5"
	type="text" value="<?php echo $location->postalcode;?>"></div>
</div>
<div class="clearfix"><label for="city">Stadt</label>
<div class="input"><input class="span3" name="city" maxlength="30"
	type="text" value="<?php echo $location->city;?>"></div>
</div>
<div class="clearfix"><label for="phone">Telefon</label>
<div class="input"><input class="span3" name="phone" maxlength="30"
	type="text" value="<?php echo $location->phone?>"></div>
</div>
<div class="clearfix"><label for="eqowner">Besitzer</label>
<div class="input"><input type="checkbox" name="eqowner" value="y"
	value="<?php if ($location->eqowner == 'y') echo 'checked'?>"> <span>Besitzerangaben
sind identisch</span></div>
</div>
</fieldset>
<fieldset class="fields fleft left-dashed">
<h3>Besitzerangaben</h3>
<div class="clearfix"><label for="owner-forename">Vorname</label>
<div class="input"><input class="span3" name="owner-forename"
	maxlength="40" type="text" value="<?php echo $owner->forename;?>"></div>
</div>
<div class="clearfix"><label for="owner-name">Nachname</label>
<div class="input"><input class="span3" name="owner-name" maxlength="30"
	type="text" value="<?php echo $owner->name;?>"></div>
</div>
<div class="clearfix"><label for="owner-str">Strasse</label>
<div class="input"><input class="span3" name="owner-str" maxlength="50"
	type="text" value="<?php echo $owner->str;?>"></div>
</div>
<div class="clearfix"><label for="owner-strnr">Hausnummer</label>
<div class="input"><input class="span2" name="owner-strnr" maxlength="4"
	type="text" value="<?php echo $owner->strnr;?>"></div>
</div>
<div class="clearfix"><label for="owner-postalcode">PLZ</label>
<div class="input"><input class="span2" name="owner-postalcode"
	maxlength="5" type="text" value="<?php echo $owner->postalcode;?>"></div>
</div>
<div class="clearfix"><label for="owner-city">Stadt</label>
<div class="input"><input class="span3" name="owner-city" maxlength="30"
	type="text" value="<?php echo $owner->city;?>"></div>
</div>
<div class="clearfix"><label for="owner-phone">Telefon</label>
<div class="input"><input class="span3" name="owner-phone" maxlength="30"
	type="text" value="<?php echo $owner->phone?>"></div>
</div>
</fieldset>
</div>

<div class="actions"><input class="btn primary" type="submit"
	name="save" value="Speichern" /> <a class="btn" href="index.php">Abbrechen</a>
</div>

</form>

<?php 
if (isset($_POST['save'])) {
	$builds = R::find('building');
	foreach ($builds as $building) {
		echo('<div class="alert-message success" style="width: 800px"><p>'.$building.'</p></div>');
	};
}
?>
</div>
</body>
</html>
