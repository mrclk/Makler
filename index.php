<?php
require 'include.php';

setup_db();

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

function description($building) {
	$location = R::load('location', $building->location_id);
	return $building->rooms.' Zimmer auf '.$building->floors.' Etagen in '.$location->postalcode.', '.$location->city;
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
<?php include_once 'head.php';?>
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
	?>
	<div class="alert-message">
	<p>Es wurden leider keine Objekte gefunden!</p>
	</div>

</div>
	<?php } else {

		foreach ($allBuildings as $building) :
		$id = $building->id;

		?>
<li class="li-item"><a href="details.php?id=<?php echo $id;?>"><img
	alt="building-thumb" class="img-thumb" src="img/120x100.gif"
	width="120" height="100"></a>
<div class="desc"><a href="details.php?id=<?php echo $id?>"><?php echo description($building);?></a></div>
<div class="option-box"><a href="#" class="btn small primary">Interesse</a>
<a href="details.php?id=<?php echo $id;?>" class="btn small">Details</a></div>
		<?php echo get_status_label($building->status);?><br>
<br>
<div class="details-overview">
<h5>Weitere Informationen:</h5>
		<?php echo details($building);?></div>
</li>
		<?php endforeach; }?>
</ol>
</div>

</body>
</html>
