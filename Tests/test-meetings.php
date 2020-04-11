<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require_once __DIR__ . '/env.php'; // Defines API_KEY and API_SECRET constants

// Make sure the server is using UTC for consistent token generation.
date_default_timezone_set("UTC");

$zoom = new Zoom\ZoomAPI(API_KEY, API_SECRET);

$users_resp = $zoom->users->list( [
	'status' => 'active',
	'page_size' => 300,
	'page_number' => 1
] );

if ( $users_resp['code'] != 200 || ! isset( $users_resp['users'] ) ) {
	// TODO: Log error
	var_dump($users_resp);
	exit;
}

$upcoming_meetings = array();

// Grab up to the next 30 meetings for each user
foreach ( $users_resp['users'] as $user ) {
	$meetings_resp = $zoom->meetings->list($user['id'], [
		'type' => 'upcoming',
		'page_size' => 30
	] );

	// Ignore if there was an error reading this user's meeting list.
	if ( $meetings_resp['code'] != 200 || ! isset( $meetings_resp['meetings'] ) ) {
		continue;
	}

	$upcoming_meetings = array_merge( $upcoming_meetings, $meetings_resp['meetings'] );
}

// Sort the upcoming meetings
usort( $upcoming_meetings, function ( $a, $b ) {
	$adt = new DateTime( $a['start_time'], new DateTimeZone($a['timezone']) );
	$bdt = new DateTime( $b['start_time'], new DateTimeZone($b['timezone']) );

	return ($adt < $bdt) ? -1 : 1;
} );

var_dump( $upcoming_meetings );		// dump a sorted list of all the upcoming meetings, up to 30 per user.