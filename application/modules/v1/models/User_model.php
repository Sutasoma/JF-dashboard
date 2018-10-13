<?php
class User_model extends CI_Model {

	function __construct() {
		
		parent::__construct();

		$this->table_name = 'admin';
	}

	function check_email_availability($email = null) {

		$count = $this->db->from($this->table_name)->where('email', $email)->get()->num_rows();
		
		if($count > 0){
			return false;
		}
		
		return true;
	}

	function add($user_data = array()) {
		
		$user_data['password'] = sha1($user_data['password']);

		$insert_query = $this->db->insert($this->table_name, $user_data);

		if(!$insert_query){
			return false;
		}

		return true;
	}

	function login($data = array()) {

		$pass = sha1($data['password']);
		$result = $this->db->from($this->table_name)
						->where('username', $data['username'])
						->where('password', $pass)
						->get()
						->row();

		return $result;
	}
}

?>