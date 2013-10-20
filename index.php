<?php
require 'flight/Flight.php';

// custom classes
require 'classes/Database.php';
require 'classes/Event.php';

session_start();

// begin routes
// to render the layout:
//    Flight::render('view_file', $data, 'content');
//    Flight::render('layout', array('title' => 'Home'));
// where $data is an array of variables to be passed to views/view_file.php

Flight::route('GET /', function(){
	$data['message'] = "Hello world!";

	Flight::render('main', $data, 'content');
	Flight::render('layout', array('title' => 'Home'));
});

Flight::route('GET /login', function(){
	Flight::render('login', array(), 'content');
	Flight::render('layout', array('title' => 'Home'));
});

Flight::route('/api/get_events', function(){
	$events = new Event();
	echo json_encode($events->get_event_names());
});

// end routes

Flight::start();
?>
