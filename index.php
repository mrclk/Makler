<?php
require 'include.php';

R::setup('mysql:host=localhost;dbname=makler','root','');
if (isset($_GET['postalcode'])) {
	$locations = R::find('location',' postalcode LIKE :postalcode 
                                  ORDER BY :postalcode', 
    array( ':postalcode'=>substr($_GET['postalcode'], 0, 2).'%'));
    
    $allBuildings = array();
    foreach ($locations as $value) {
    	array_push($allBuildings, R::findOne('building', 'location_id ='.$value->id));
    }
} else {
	// get all buildings in db
	$allBuildings = R::find('building');
}

function desc($building) {
	$location = R::load('location', $building->location_id);
	return $building->rooms.' Zimmer auf '.$building->floors.' Etagen in '.$location->postalcode;
}

function details($building) {
	$echo = '<p><strong>Fl&auml;che: </strong>';
	$echo .= $building->qm.' m&sup2;';
	$echo .= '<strong> | Preis: </strong>'.money($building->price).' &euro;</p>';
	return $echo;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Maklerb&uuml;ro M&ouml;nich - &Uuml;bersicht</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<img src="img/logo.png">
<div class="content">
<div class="header"><a class="btn success" id="add"
	href="addbuilding.php">Neues Objekt</a>
<h1>Unsere Angebote</h1>
<!-- postal search -->

<h3>Suchen Sie Objekte in Ihrer Umgebung:</h3>
<form action>

<div class="clearfix postalsearch"><input class="span2" id
	name="postalcode" maxlength="5" type="text" placeholder="PLZ"></div>
<button class="btn small">Suchen</button>
</form>


</div>
<!-- list of buildings -->
<ol id="building-list">
<?php
if ($allBuildings == null) {
	echo '<div class="alert-message"><p>Es wurden leider keine Objekte gefunden!</p></div></div>';
} else {

	foreach ($allBuildings as $building) {
		$id = $building->id;
		$detailPage = 'details.php?id='.$id;
		$details = '<p>Bitte melden Sie Interesse f&uumlr dieses Objekt an, um weitere Details zu sehen.</p>';

		echo '<li class="li-item">';
		echo '<a href="'.$detailPage.'"><img alt="building-thumb" class="img-thumb" src="http://innenarchi.org/dekoration/wp-content/uploads/2011/06/haus1.jpg" width="120" height="100"></a>';
		echo '<div class="desc"><a href="'.$detailPage.'">'.desc($building).'</a></div>';
		echo '<div class="option-box"><a href="#" class="btn small primary">Interesse</a>
			  <a href="'.$detailPage.'" class="btn small">Details</a></div>';

		echo get_status_label($building->status).'<br><br>';

		if ($building->status == 'Verkauft') {
			$details = '<p>Dieses Objekt wurde bereits verkauft.</p>';
		}

		echo '<div class="details-overview"><h5>Weitere Informationen:</h5>'.details($building);
		echo '</div></li>';
	}
}
?>
</ol>
</div>

</body>
</html>
