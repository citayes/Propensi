<?php
	class admin extends DataMapper {
		var $has_many = array('riwayat');
		var $has_one = array('pengguna');
	}
