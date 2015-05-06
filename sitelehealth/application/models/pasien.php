<?php
	class pasien extends DataMapper {
		var $has_many = array('analisi', 'medical_record','dokter_gigi');

				function remove($id){
		$pasien = new pasien();
		$pasien->get();

		//$sql = "DELETE FROM `penggunas` WHERE `id` = $id";
		$sql = "delete from pasiens where id = '$id'";
		$pasien->query($sql);
	}
	}
