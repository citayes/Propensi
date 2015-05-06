<?php
	class Pengguna extends CI_Model{	
		function create($Username, $data_pengguna){
			$result = $this->db->query("select * from pengguna where Username='$Username'");		
			foreach($result->result() as $row) return false;
			$this->db->insert('pengguna', $data_pengguna); return true;			
		}
		function signin($Username, $Password){
			$result = $this->db->query("select * from pengguna where Username='$Username' && Password='$Password'");
			return $result->result();
		}
		function check($Username, $Password){
			$result = $this->db->query("select * from pengguna where Username='$Username' && Password='$Password'");
			foreach($result->result() as $row) return true;
		}
	}
?>