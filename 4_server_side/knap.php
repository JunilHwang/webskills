<?php
	// 적재할 수 있는 중량 목록
	$list = [8, 4, 15, 8, 4, 3];

	$limit = 15;		// 제한 용량
	$max = 0;			// 적재 용량
	$pocket = [];		// 동일 항목 처리

	// 최적의 중량 구하기
	getWeight();

	// 결과 출력
	print_pre([$pocket, $max]);
	
	// 분기와 한정 - 깊이 우선 탐색
	function getWeight ($stack = [], $weight = 0, $level = 0) {
		// 전역 변수 사용
		global $max, $limit, $list, $pocket, $weights, $cnt;

		// 모든 경우의 수
		foreach ($list as $key=>$data) {
			if (in_array($key, $stack)) continue;
			$w = $weight;	// weight 은 반복용 변수이므로 새로운 변수 생성
			$n = $stack;	// stack 은 반복용 변수이므로 새로운 변수 생성
			if ($w + $data <= $limit) {
				// 새로운 중량이 limit 보다 작거나 같을 경우, 반영
				// 그렇지 않을 경우, 다음으로 넘어감
				$w += $data;
				$n[] = $key;
			}

			// 하나의 flow에서 모든 경우를 체크했을 때 조건에 맞는 지 검사함
			if ($level >= count($list)) {
				// 판별된 최대 적재 용량보다 $w가 작으면, return
				if ($max > $w) return; 
				sort($n);
				$str = implode(',', $n);
				// 중복 여부를 검사한 뒤
				if (!in_array($str, $pocket)) {
					// $w가 $max보다 클 경우, pocket 스택을 초기화. 아닐 경우 누적
					if ($max < $w) {
						$pocket = [$str];
						$max = $w;
					} else {
						$pocket[] = $str;
					}
				}
				return;
			}
			getWeight($n, $w, $level + 1);
		}
	}

	// 디버깅 용 함수
	function println ($ele) {
		echo "<p>{$ele}</p>";
	}

	function print_pre ($ele) {
		echo "<pre>";
		print_r($ele);
		echo "</pre>";
	}
