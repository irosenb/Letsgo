<?php
require 'flight/Flight.php';

// custom classes
require 'classes/Database.php';
require 'classes/Event.php';
require 'classes/User.php';

session_start();

// begin routes
// to render the layout:
//    Flight::render('view_file', $data, 'content');
//    Flight::render('layout', array('title' => 'Home'));
// where $data is an array of variables to be passed to views/view_file.php

Flight::route('GET /', function(){
	if(isset($_SESSION['uid']) && $_SESSION['uid'] != 0) {
		$user = new User($_SESSION['uid']);
		Flight::render('main', array('login_name' => $user->get_name()), 'content');
		Flight::render('layout');
	} else {
		Flight::render('login', array(), 'content');
		Flight::render('layout', array('loginpage' => true));
	}
});

Flight::route('POST /login', function(){
	$auth = new User();
	$auth = $auth->authenticate($_POST['email'], $_POST['password']);
	if($auth) {
		$_SESSION['uid'] = $auth;
		Flight::redirect('/');
	} else {
		Flight::redirect('/');
	}
});

Flight::route('GET /logout', function(){
	session_destroy();
	Flight::redirect('/');
});

Flight::route('/api/*', function(){
	if(isset($_SESSION['uid']) && $_SESSION['uid'] != 0) {
		return true;
	} else {
		return false;
	}
});

Flight::route('/api/get_events', function(){
	$events = new Event();
	echo json_encode(array('suggestions' => $events->get_event_names()));
});

// end routes

Flight::start();
?>
