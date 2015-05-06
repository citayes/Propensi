<?php
class pengguna extends DataMapper {
	var $has_many = array('mengirim', 'analisi');
	var $has_one = array('dokter_gigi', 'admin');

		function remove($id){
		$pengguna = new pengguna();
		$pengguna->get();

		//$sql = "DELETE FROM `penggunas` WHERE `id` = $id";
		$sql = "delete from penggunas where id = '$id'";
		$pengguna->query($sql);
	}
}

/* End of file template.php */
/* Location: ./application/models/template.php */
?>