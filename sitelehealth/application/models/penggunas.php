<?php
	class penggunas extends CI_Model{
		function delete($id){
			$this->db->query("delete from penggunas where id='$id'");
			return true;
		}
		function deletePasien($id){
			$this->db->query("delete from pasiens where id='$id'");
			return true;	
		}
	}
?>