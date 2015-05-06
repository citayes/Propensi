
<?php
	class pusat extends DataMapper {
		var $has_many = array('analisi', 'jadwal_praktek','pasien');
	}