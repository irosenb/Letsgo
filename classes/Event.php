<?php

class Event {
	private $db;

	public function __construct() {
		$database = new Database();
		$this->db = $database->db;
	}

	public function get_events() {
		$sql = "SELECT * FROM events";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function get_event_names() {
		$events = $this->get_events();
		
		$names = array();

		if(!empty($events)) {
			foreach($events as $event) {
				array_push($names, $event['title']);
			}
		}
		return $names;
	}
}