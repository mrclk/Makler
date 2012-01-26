<?php

function money($amount) {
	;
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