<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Maklerb&uuml;ro M&ouml;nich - Details</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">
</head>

<body>
<div class="container"><img src="img/moenich.gif"></div>
<div class="content">
	<div class="header">
	<?php 
	require_once 'rb.php';
	require 'utils.php';
	R::setup('mysql:host=localhost;dbname=makler','root','');
	
	if (isset($_GET['id'])) {
		$building = R::load('building', $_GET['id']);
		if ($building->id != 0) {
			echo '<h1>&Uuml;bersicht <small>Objekt #'.$building->id.' in '.$building->postalcode.'</small></h1></div>';
			
			echo '<div class="detail-box">
					<img class="img-big" alt="building"
					src="img/300x250.gif" width="300" height="250" />
					<div class="details">
					<div class="detail-item">';
			
			echo '<h5>Eigenschaften</h5>
					<p><strong>Zimmer:</strong> '.$building->rooms.'</p>
					<p><strong>Ebenen:</strong> '.$building->floors.'</p>
					<p><strong>Fl&auml;che:</strong> '.$building->qm.' m&sup2;</p>
					<p><strong>Preis:</strong> '.$building->price.' &euro;</p>
					<p><strong>Status:</strong> '.get_status_label($building->status).'</p>';
			
			echo '</div></div>';
			
			echo '
			<div class="detail-item left-dashed">
				<h5>Ortsangabe</h5>
				<address>
				<p>Klaus M&uuml;ller</p>
				<p>Halmweg 12</p>
				<p>44227 Dortmund</p>
				<abbr title="Telefon">Tel:</abbr> (0231) 456-7890</address>
			</div>
			<div class="detail-item left-dashed">
				<h5>Besitzer/in</h5>
				<address>
				<p>Klaus M&uuml;ller</p>
				<p>Halmweg 12</p>
				<p>44227 Dortmund</p>
				<abbr title="Telefon">Tel:</abbr> (0231) 456-7890</address>
			</div>';

			echo '</div>';
			
			echo '<div class="actions">
				<a href="#" class="btn primary">Interesse</a>
				<a href="index.php" class="btn">Zur&uuml;ck</a>
				</div>';
		} else {
			echoAlert();
		}
	} else {
		echoAlert();
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