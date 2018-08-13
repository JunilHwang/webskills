<?php
	$sql = "";
	for ($i=1; $i<=24; $i++) {
		$sql .= "
			INSERT INTO su_time_cost SET
			source = '{$i}', destination = '{$i}', cost = '0', type = 1; \n
		";
		$sql .= "
			INSERT INTO su_time_cost SET
			source = '{$i}', destination = '{$i}', cost = '0', type = 2; \n
		";
	}
	