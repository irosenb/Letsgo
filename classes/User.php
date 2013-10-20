<?php

class user {
	private $db;
	public $uid;

	public function __construct($uid = false) {
		$db = new Database();
		$this->db = $db->db;
		$this->uid = $uid;
	}

	public function authenticate($email, $password) {
		$sql = "SELECT uid FROM users WHERE email=? AND sha1=?";
		$query = $this->db->prepare($sql);
		$query->execute(array($email, sha1($password)));
		$results = $query->fetchAll();
		return (empty($results)) ? false : $results[0]['uid'];
	}

	public function get_name($uid = false) {
		if(!$uid) $uid = $this->uid;
		$sql = "SELECT name FROM users WHERE uid=?";
		$query = $this->db->prepare($sql);
		$query->execute(array($uid));
		return $query->fetchAll()[0]['name'];
	}

	public function create_user($name, $password, $email, $phone) {
		$sql = "INSERT INTO users(name, sha1, email, phone) VALUES (?, ?, ?, ?)";
		$query = $this->db->prepare($sql);
		$query->execute(array($name, sha1($password), $email, $phone));
		$this->uid = $this->db->lastInsertId();
		return $this->uid;
	}
}