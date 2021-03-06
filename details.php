<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Maklerb&uuml;ro M&ouml;nich - Details</title>
<?php include_once 'head.php';?>
</head>
<body>
<img src="img/logo.png">
<div class="content">
<div class="header">
<?php 
require 'include.php';

setup_db();

if (isset($_GET['id'])) {
	$building = R::load('building', $_GET['id']);
	$location = R::load('location', $building->location_id);
	$owner = R::load('owner', $building->owner_id);

	if ($building->id != 0) {
		echo '<h1>&Uuml;bersicht <small>Objekt #'.$building->id.' in '.$location->postalcode.'</small></h1></div>';
			
		echo '<div class="detail-box">
					<img class="img-big" alt="building"
					src="img/300x250.gif" width="300" height="250" />
					<div class="details">
					<div class="detail-item">';
			
		echo '<h5>Eigenschaften</h5>
					<p><strong>Zimmer:</strong> '.$building->rooms.'</p>
					<p><strong>Ebenen:</strong> '.$building->floors.'</p>
					<p><strong>Fl&auml;che:</strong> '.$building->qm.' m&sup2;</p>
					<p><strong>Preis:</strong> '.money($building->price).' &euro;</p>
					<p><strong>Min. Preis:</strong> '.money($building->minprice).' &euro;</p>
					<p><strong>Status:</strong> '.get_status_label($building->status).'</p>';
			
		echo '</div></div>';
			
		echo '
			<div class="detail-item left-dashed">
				<h5>Ortsangabe</h5>
				<address>
				<p>'.$location->forename.' '.$location->name.'</p>
				<p>'.$location->str.' '.$location->strnr.'</p>
				<p>'.$location->postalcode.' '.$location->city.'</p>
				<abbr title="Telefon">Tel:</abbr> '.$location->phone.'</address>
			</div>
			<div class="detail-item left-dashed">
				<h5>Besitzer/in</h5>
				<address>
				<p>'.$owner->forename.' '.$owner->name.'</p>
				<p>'.$owner->str.' '.$owner->strnr.'</p>
				<p>'.$owner->postalcode.' '.$owner->city.'</p>
				<abbr title="Telefon">Tel:</abbr> '.$owner->phone.'</address>
			</div>';

		echo '</div>';
			
		echo '	<form action method="post">
				<div class="actions">
				<a href="#" class="btn primary">Interesse</a>
				<a href="editbuilding.php?id='.$building->id.'" class="btn success">Bearbeiten</a>
				<a href="index.php" class="btn">Zur&uuml;ck</a>
				<input class="btn danger" type="submit" name="delete" id="delete" value="L&ouml;schen"/>
				</div></form>';
	} else {
		echoAlert();
	}
} else {
	echoAlert();
}

if (isset($_POST['delete'])) {


	R::trash($building);
	R::trash($location);
	R::trash($owner);

	header( "refresh:0;url=index.php" );

}

function echoAlert() {
	echo '<div class="alert-message error">
        <p><strong>Ups!</strong> Es wurde kein Eintrag gefunden. <a href="index.php">Hier geht es zur&uuml;ck zur Startseite.</a>.</p>
      </div></div>';
}
?>
</div>
</body>
</html>