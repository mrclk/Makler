<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Maklerb&uuml;ro M&ouml;nich</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">
</head>

<body>
<div class="container"><img src="img/moenich.gif"></div>
<div class="content">
	<div class="header">
	<?php 
	function echoAlert() {
		echo '<div class="alert-message error">
        <p><strong>Ups!</strong> Es wurde kein Eintrag gefunden. <a href="index.php">Hier geht es zur&uuml;ck zur Startseite.</a>.</p>
      </div>';
	}
	
	if (isset($_GET['id'])) {
		$building = R::load('building', $_GET['id']);
		echo '<h1>&Uuml;bersicht <small>Objekt #'.$id.' in '.$postal.'</small></h1>';
	} else {
		echoAlert();
	}
	
	
	
	?>
		
	</div>

	<div class="detail-box">
		<img class="img-big" alt="building"
		src="img/300x250.gif" width="300" height="250" />
	
		<div class="details">
			<div class="detail-item">
				<h5>Eigenschaften</h5>
				<p><strong>Zimmer:</strong> 4</p>
				<p><strong>Ebenen:</strong> 1</p>
				<p><strong>Fl&auml;che:</strong> 56 m&sup2;</p>
				<p><strong>Preis:</strong> 200.000 &euro;</p>
				<p><strong>Status:</strong> <span class="label important">Verkauft</span></p>
			</div>
				<div class="detail-item left-dotted">
				<h5>Ortsangabe</h5>
				<address>
				<p>Klaus M&uuml;ller</p>
				<p>Halmweg 12</p>
				<p>44227 Dortmund</p>
				<abbr title="Telefon">Tel:</abbr> (0231) 456-7890</address>
			</div>
				<div class="detail-item left-dotted">
				<h5>Besitzer/in</h5>
				<address>
				<p>Klaus M&uuml;ller</p>
				<p>Halmweg 12</p>
				<p>44227 Dortmund</p>
				<abbr title="Telefon">Tel:</abbr> (0231) 456-7890</address>
			</div>
		</div>
	</div>
	<div class="actions">
		<a href="#" class="btn primary">Interesse</a>
		<a href="#" class="btn">Zur&uuml;ck</a>
	</div>
</div>
</body>
</html>
<?php
?>