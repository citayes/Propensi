<?php
	class drg_lain extends DataMapper {	
		var $has_many = array('medical_record');
		var $has_one = array('dokter_gigi');
	}
