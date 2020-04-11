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

var_dump( $users_resp );