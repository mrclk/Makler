<?php

function money($amount) {
	$arr = str_split(strrev($amount), 3);
	$money = '';
	for ($i = 0; $i < count($arr)-1; $i++) {
		$money .= $arr[$i].'.'; 
	}
	
	$money .= $arr[$i];
	
	return strrev($money);
}

function get_status_label($status) {
	switch ($status) {
		case 'Verkauft':
			$labelClass = 'important';
			$status = 'verkauft';
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
	
	return '<span class="label '.$labelClass.'">'.$status.'</span>';
}
?>