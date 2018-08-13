<?php

class Diff {

    const UNMODIFIED = 0;
   	const DELETED = 1;
   	const INSERTED = 2;
    var $diff;

    function __construct($str1, $str2, $compareCharacters = false){

        // 줄단위 검사 or 한 글자씩 검사
        $start = 0;
        if ($compareCharacters) {
            $seq1 = $str1;
            $seq2 = $str2;
            $end1 = strlen($str1) - 1;
            $end2 = strlen($str2) - 1;
        } else {
            $seq1 = preg_split('/\R/', $str1);
            $seq2 = preg_split('/\R/', $str2);
            $end1 = count($seq1) - 1;
            $end2 = count($seq2) - 1;
        }
        $len = $compareCharacters ? strlen($seq1) : count($seq1);

        // 앞에서 부터 비교
        while ($start <= $end1 && $start <= $end2 && $seq1[$start] == $seq2[$start])
        	$start++;

        // 뒤에서 부터 비교
        while ($end1 >= $start && $end2 >= $start && $seq1[$end1] == $seq2[$end2]) {
            $end1--;
            $end2--;
        }
        // 위의 과정을 거쳐서 비교할 범위를 정함.

        // 가장 긴 서브 시퀀스 길이 계산
        $table = self::computeTable($seq1, $seq2, $start, $end1, $end2);

        // 부분별 diff 생성
        $partialDiff = self::part($table, $seq1, $seq2, $start);

        // 전체 diff 생성
        $diff = [];
        for ($i = 0; $i < $start; $i++)
        	$diff[] = [$seq1[$i], self::UNMODIFIED];

        while (count($partialDiff) > 0)
        	$diff[] = array_pop($partialDiff);

        for ($i = $end1+1; $i < $len; $i++)
            $diff[] = [$seq1[$i], self::UNMODIFIED];

        // return the diff
        $this->diff = $diff;

    }

    public static function compareFiles($file1, $file2, $compareCharacters = false){
        return new Diff(file_get_contents($file1), file_get_contents($file2), $compareCharacters);
    }

    private static function computeTable($seq1, $seq2, $start, $end1, $end2){

    	// 비교할 길이 설정
        $len1 = $end1 - $start + 1;
        $len2 = $end2 - $start + 1;
        $table = array(array_fill(0, $len2 + 1, 0));

        for ($i = 1; $i <= $len1; $i++) {
            $table[$i] = [0];
            // 가장 긴 공통 서브 시퀀스 길이 저장
            for ($j = 1; $j <= $len2; $j++)
                $table[$i][$j] = $seq1[$i + $start - 1] == $seq2[$j + $start - 1]
                				 ? $table[$i-1][$j-1] + 1
                				 : max($table[$i-1][$j], $table[$i][$j-1]);
        }

        return $table;

    }

    private static function part($table, $seq1, $seq2, $start){
        $diff = [];
        $i = count($table) - 1;
        $j = count($table[0]) - 1;

        // 뒤에서 부터 검사
        while ($i > 0 || $j > 0) {
            if ($i > 0 && $j > 0 && $seq1[$i+$start-1] == $seq2[$j+$start-1]) {
        		// 다른점이 없음
                $diff[] = [$seq1[$i + $start - 1], self::UNMODIFIED];
                $i--; $j--;
            } else if ($j > 0 && $table[$i][$j] == $table[$i][$j - 1]) {
            	// 추가됨
                $diff[] = [$seq2[$j + $start - 1], self::INSERTED];
                $j--;
            } else {
            	// 삭제됨
                $diff[] = [$seq1[$i + $start - 1], self::DELETED];
                $i--;
            }
        }
        return $diff;
    }

    public function toString(){

        $string = '';
        $diff = $this->diff;

        // loop over the lines in the diff
        foreach ($diff as $line) {
            switch ($line[1]) {
                case self::DELETED  :
                	$string .= "<span class=\"delete\">{$line[0]}</span>"; break;
                case self::INSERTED :
                	$string .= "<span class=\"insert\">{$line[0]}</span>"; break;
                default :
                	$string .= $line[0]; break;
            }
            $string .= PHP_EOL;
        }

        return $string;
    }

}