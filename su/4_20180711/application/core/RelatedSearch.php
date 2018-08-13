<?php
class RelatedSearch {

	private static $key_list;
	private static $unique;
	private static $stack;

	// keyword fetch 및 stack entry 생성 
	public static function init () {

		// keyword list fetch 
		$model = new Model();
		$list = $model->fetchAll("SELECT key_list FROM {$model->table->searched}");

		// variable initialize
		$key_list = $unique = $stack = [];

		// unique keyword 구하기 
		foreach ($list as $data) {
			$keys = json_decode($data->key_list);
			$key_list[] = $keys;
			foreach ($keys as $idx=>$key) {
				$unique[$key] = isset($unique[$key])
								? ++$unique[$key]
								: 1;

				// 최소 2번 이상 검색된 대상 기준으로 연관 검색어 리스트를 만든다.
				if($unique[$key] > 2)
					$stack[$key] = [];
			}
		}

		// value 기준으로 내림차순 
		arsort($unique);

		// return
		self::$stack = $stack;
		self::$unique = $unique;
		self::$key_list = $key_list;
	}

	// keyword list 정제 
	public static function reDefine () {
		$unique   = self::$unique;
		$key_list = self::$key_list;
		$new_list = [];

		foreach ($key_list as $list) {
			$arr = [];
			foreach ($list as $key)
				if ($unique[$key] > 2)
					$arr[$key] = $unique[$key];
			arsort($arr);
			if (count($arr)) $new_list[] = $arr;
		}
		self::$key_list = $new_list;
	}

	// 연관 검색어 리스트 생성
	public static function getRelatedList ($select_key) {

		// initialize
		self::init();
		self::reDefine();

		// variable define
		$stack    = self::$stack;
		$key_list = self::$key_list;
		$tree     = [];

		// create tree
		foreach ($key_list as $list) {
			// root 선택
			$ptr = &$tree;
			$parent = null;
			$oneStack = [];
			foreach ($list as $key=>$val) {
				if (isset($ptr[$key]))
					$ptr[$key]['cnt'] += 1;
				else {
					$ptr[$key] = ['cnt'=>1, 'children'=>[]];
					// stack 분기 생성
					if(count($oneStack)) $stack[$key][] = $oneStack;
				}

				// 자식 선택
				$ptr = &$ptr[$key]['children'];

				// stack에 누적
				$oneStack[] = $key;
			}
		}
		$selected = isset($stack[$select_key]) ? $stack[$select_key] : [];

		// 연관 검색어 리스트 반환
		return $selected;
	}
}