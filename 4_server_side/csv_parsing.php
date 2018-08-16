<?php
	$url = __DIR__."/csv/notebook.csv";

	function csv_parsing ($url) {
		$arr = [];
		$handle = fopen($url, "r");
	    while ($data = fgetcsv($handle, 1000, ",")) $arr[] = $data;
	    fclose($handle);
		return $arr;
	}

	$csv = csv_parsing($url);

	print_r($csv);