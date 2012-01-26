<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Maklerb&uuml;ro M&ouml;nich</title>
<link rel="stylesheet"
	href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<div class="container"><img src="img/moenich.gif"></div>
<div class="content">
<div class="header">
<h1>Unsere Angebote</h1>
<!-- postal search -->

<h3>Suchen Sie Objekte in Ihrer Umgebung:</h3>

<form action>
<div class="clearfix postalsearch"><input class="span2" id
	name="postalcode" type="text" placeholder="PLZ"></div>
<button class="btn small">Suchen</button>
</form>
</div>
<!-- list of buildings -->
<ol style="width: 750px">
<?php
require 'rb.php';

function desc($building) {
	return $building->rooms.' Zimmer auf '.$building->floors.' Etagen in '.$building->postalcode;
}

R::setup('mysql:host=localhost;dbname=makler','root','');

$allBuildings = R::find('building');

if ($allBuildings == null) {
	echo '<p>Es wurden leider keine Objekte gefunden!</p>';
} else {

	foreach ($allBuildings as $build) {
		switch ($build->status) {
			case 'Verkauft':
				$labelClass = 'important';
				$status = 'verkauft';
				$details = '<p>Dieses Objekt wurde bereits verkauft.</p>';
				break;
			case 'Reserviert':
				$labelClass = 'warning';
				$status = 'reserviert';
				break;
			case 'Verfuegbar':
				$labelClass = 'success';
				$status = 'verf&uumlgbar';
				break;
			default:
				$labelClass = 'default';
				$status = 'unbekannt';
				break;
		}

		$id = $build->id;
		$detailPage = 'details.php?id='.$id;
		$details = '<p>Bitte melden Sie Interesse f&uumlr dieses Objekt an, um weitere Details zu sehen.</p>';

		echo '<li class="li-item">';
		echo '<a href="'.$detailPage.'"><img alt="building-thumb" class="img-thumb" src="img/120x100.gif" width="120" height="100"></a>';
		echo '<div class="desc"><a href="'.$detailPage.'">'.desc($build).'</a></div>';
		echo '<div class="option-box"><a href="#" class="btn small primary">Interesse</a>
			  <a href="'.$detailPage.'" class="btn small">Details</a></div>';

		echo '<span class="label '.$labelClass.' status">'.$status.'</span> <br><br>';

		echo '<div class="details-overview"><h5>Weitere Informationen:</h5>'.$details;
		echo '</div></li>';

	}



}
?>
</ol>
<img alt="" src="">
</div>

</body>
</html>
