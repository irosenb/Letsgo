<?php
require 'flight/Flight.php';

// custom classes
require 'classes/Database.php';

session_start();

// begin routes
// to render the layout:
//    Flight::render('view_file', $data, 'content');
//    Flight::render('layout', array('title' => 'Home'));
// where $data is an array of variables to be passed to views/view_file.php

Flight::route('GET /', function(){
	$data['message'] = "Hello world!";

	Flight::render('home', $data, 'content');
	Flight::render('layout', array('title' => 'Home'));
});

Flight::route('GET /login', function(){
	Flight::render('login', array(), 'content');
	Flight::render('layout', array('title' => 'Home'));
});

// end routes

Flight::start();
?>
