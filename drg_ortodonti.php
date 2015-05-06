<?php
	class drg_ortodonti extends CI_Model{	
		function create($Username, $data_dokter_ortho){
			$result = $this->db->query("select * from drg_ortodonti where Username='$Username'");		
			foreach($result->result() as $row) return false;
			$this->db->insert('drg_ortodonti', $data_dokter_ortho); return true;			
		}
	}
?>