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
    echo "<pre>";
    print_r($csv);
    echo "</pre>";