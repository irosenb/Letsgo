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

Flight::route('/api/search', function(){
	$query = Flight::request()->query['query'];
	$results = new Event();
	$results = $results->search($query);
	Flight::render('search_results', array('results' => $results));
});

Flight::route('/api/event/@eid:[0-9]+', function($eid){
	$event = new Event($eid);
	$event = $event->get_event();
	Flight::render('event', $event);
});

Flight::route('/api/join_event/@eid:[0-9]+', function($eid){
	$event = new Event($eid);
	echo $event->add_attendee($eid);
});

Flight::route('POST /api/create_event', function(){
	$new = new Event();
	$time_start = str_replace("T", " ", $_POST['time_start']);
	$time_end = str_replace("T", " ", $_POST['time_end']);
	echo $new->create_event($_POST['title'], $_POST['description'], $_POST['location'], $time_start, $time_end);
});

// end routes

Flight::start();
?>
