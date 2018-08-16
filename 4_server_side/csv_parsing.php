<?php
	$url = __DIR__."/csv/notebook.csv";

	function csv2json ($url) {
		$csv = trim(file_get_contents($url));
		$arr = explode("\n", $csv);
		foreach ($arr as $key=>$line) {
			$arr[$key] = explode(',', $line);
		}
		print_r($arr);
	}

	csv2json($url);