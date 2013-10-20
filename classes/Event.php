<?php

class Event {
	private $db;
	private $eid;

	public function __construct($eid = false) {
		$db = new Database();
		$this->db = $db->db;
		$this->eid = $eid;
	}

	public function search($term = false) {
		$sql = "SELECT * FROM events WHERE title LIKE ? AND (time_end > NOW() OR time_start >= NOW())";
		$query = $this->db->prepare($sql);
		$query->execute(array('%' . str_replace(' ', '%', $term) . '%'));
		return $query->fetchAll();
	}

	public function get_event_names() {
		$events = $this->search();
		
		$names = array();

		if(!empty($events)) {
			foreach($events as $event) {
				array_push($names, $event['title']);
			}
		}

		return $names;
	}

	public function get_event($eid = false) {
		if(!$eid) $eid = $this->eid;
		$sql = "SELECT * FROM events WHERE eid=?";
		$query = $this->db->prepare($sql);
		$query->execute(array($eid));
		$result = $query->fetchAll()[0];
		$result['attendees'] = $this->attendees($eid);
		$result['is_attendee'] = $this->is_attendee($eid);
		return $result;
	}

	public function attendees($eid = false) {
		if(!$eid) $eid = $this->eid;
		$sql = "SELECT users_events.uid, users.name FROM users_events INNER JOIN users ON users_events.uid=users.uid WHERE users_events.eid=?";
		$query = $this->db->prepare($sql);
		$query->execute(array($eid));
		$results = $query->fetchAll();

		foreach($results as $result) {
			$attendees[$result['uid']] = $result['name'];
		}

		return $attendees;
	}

	public function is_attendee($eid = false) {
		if(!$eid) $eid = $this->eid;
		$sql = "SELECT eid FROM users_events WHERE uid=? AND eid=?";
		$query = $this->db->prepare($sql);
		$query->execute(array($_SESSION['uid'], $eid));
		$results = $query->fetchAll();

		return (empty($results)) ? false : true;
	}

	public function add_attendee($eid = false) {
		if(!$eid) $eid = $this->eid;
		$sql = "INSERT INTO users_events(uid, eid) VALUES (?, ?)";
		$query = $this->db->prepare($sql);
		return $query->execute(array($_SESSION['uid'], $eid));
	}

	public function create_event($title, $description, $location, $time_start, $time_end) {
		if(!$time_end) $time_end = null;
		$sql = "INSERT INTO events(title, description, location, time_start, time_end) VALUES (?, ?, ?, ?, ?)";
		$query = $this->db->prepare($sql);
		if($query->execute(array($title, $description, $location, $time_start, $time_end))) {
			$this->eid = $this->db->lastInsertId();

			$this->add_attendee($this->eid);

			return $this->eid;
		} else {
			return 'false';
		}
	}
}