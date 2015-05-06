<?php
	class drg_ortodonti extends DataMapper {
		var $has_many = array('jadwal_praktek', 'analisi', 'pasien');
		var $has_one = array('dokter_gigi');
	}