<?php
	class dokter_gigi extends DataMapper {
		var $has_many = array('pasien');
		var $has_one = array('pengguna', 'drg_lain', 'drg_ortodonti');
	}
