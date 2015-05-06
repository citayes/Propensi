<?php
	class analisi extends DataMapper {
		var $has_one = array('pasien','drg_ortodonti','pengguna');
		var $has_many=array('pengguna');
	}
