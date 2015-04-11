<?php
	class Pengguna extends CI_Model{	
		function create($Username, $data_pengguna){
			$result = $this->db->query("select * from pengguna where Username='$Username'");		
			foreach($result->result() as $row) return false;
			$this->db->insert('pengguna', $data_pengguna); return true;			
		}
	}
?>