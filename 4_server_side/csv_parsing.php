<?php
	$url = __DIR__."/csv/notebook.csv";

	function csv_parsing ($url) {
		$csv = trim(file_get_contents($url));
		$arr = explode("\n", $csv);
		foreach ($arr as $key=>$line) {
			$arr[$key] = explode(',', $line);
		}
		return $arr;
	}

	$csv = csv_parsing($url)

	print_r($csv);