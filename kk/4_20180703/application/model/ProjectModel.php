<?php
Class ProjectModel extends Model {

	var $projectId;

	// project 정보 
	function getData ($version = null) {
		$param = $this->param;
		$version = isset($version) ? $version : $param->version;
		$this->sql = "
			SELECT  p.*,
					m.name as writer,
					v.root
			FROM 	project p
			join 	member m on p.member = m.idx
			join 	project_version v on v.project = p.idx
			where 	p.idx = '{$param->idx}'
			and 	v.version = '{$version}'
			order by p.version desc limit 1
		";
		return $this->fetch();
	}

	// project file list 정보 
	function getFileList () {
		$param = $this->param;
		$this->sql = "
			SELECT 	*
			FROM 	file
			where 	project = '{$param->idx}'
			and 	parent = '{$param->file}'
			and		version = '{$param->version}'
			and 	state = 1
			order by type asc, name asc
		";
		return $this->fetchAll();
	}

	// parent directory
	function getParentDir () {
		$dir = $this->param->file;
		$parent = $this->fetch("SELECT * FROM file where idx = '{$dir}'")->parent;
		return $parent;
	}

	// get file info
	function getFile ($file = null) {
		$file = isset($file) ? $file : $this->param->file;
		$this->sql = "SELECT * FROM file where idx = '{$file}';";
		return $this->fetch();
	}

	// get file in path
	function getFileInPath ($file_name) {
		$param = $this->param;
		$this->sql = "SELECT * FROM file where parent = '{$param->file}' and name = '{$file_name}' and state = 1";
		return $this->fetch();
	}

	// delete file
	function deleteFile ($data) {
		$this->sql = "DELETE FROM file where idx = '{$data->idx}';";
		$this->query();
	}

	// insert file
	function insertFile ($file_name, $dir_uri) {
		$param = $this->param;
		$this->sql = "
			SELECT 	idx
			FROM 	file
			where	project = '{$param->idx}'
			and 	version = '{$param->version}'
			and 	parent = '{$param->file}'
			and 	name = '{$file_name}'
			and 	state = 0
		";
		$this->sql = "
			INSERT INTO file SET
			project = '{$param->idx}',
			version = '{$param->version}',
			parent = '{$param->file}',
			name = '{$file_name}',
			type = 'file',
			uri = '{$dir_uri}/{$file_name}'
		";
		return $this->query();
	}

	// version list
	function getVersionList () {
		$this->sql = "SELECT * FROM project_version where project = '{$this->param->idx}' order by idx desc;";
		return $this->fetchAll();
	}

	// compare List
	function getCompareList () {
		$param = $this->param;
		$sql = "SELECT root FROM project_version where project='{$param->idx}' and version=";
		$parent1 = isset($param->compareFile) ? $param->compareFile : $this->fetch("{$sql}'{$param->compareFrom}'")->root;
		$parent2 = isset($param->file) ? $param->file : $this->fetch("{$sql}'{$param->version}'")->root;
		$list1 = $this->fetchAll("
			SELECT 	*
			FROM 	file
			WHERE 	project = '{$param->idx}'
			AND 	version = '{$param->compareFrom}'
			AND 	parent = '{$parent1}'
			AND 	state = 1
			ORDER BY type asc, name asc;
		");
		$list2 = $this->fetchAll("
			SELECT 	*
			FROM 	file
			WHERE 	project = '{$param->idx}'
			AND 	version = '{$param->version}'
			AND 	parent = '{$parent2}'
			AND 	state = 1
			ORDER BY type asc, name asc;
		");
		$files1 = $files2 = $files = $dirs = [];
		// 과거 프로젝트 정보 등록
		foreach ($list1 as $data){
			$name = $data->name;
			$files1[] = $name;
			$dataSet = (object)['compare'=>0, 'prev_data'=>$data, 'now_data'=>null];
			if ($data->type == 'dir') {
				$dirs[$name] = $dataSet;
			} else {
				$files[$name] = $dataSet;
			}
		}
		// 현재 프로젝트 정보 등록
		foreach ($list2 as $data) {
			$files2[] = $name = $data->name;
			if (!in_array($name, $files1)) {
				$dataSet = (object)['compare'=>1, 'prev_data'=>null, 'now_data'=>$data];
				if ($data->type == 'dir') {
					$dirs[$name] = $dataSet;
				} else {
					$files[$name] = $dataSet;
				}
			} else {				
				if ($data->type == 'dir') {
					$dirs[$name]->now_data = $data;
				} else {
					$files[$name]->now_data = $data;
				}
			}
		}
		// 과거 프로젝트 정보 최신화
		foreach ($list1 as $data) {
			$dataSet = (object)['compare'=>-1, 'prev_data'=>$data, 'now_data'=>null];
			if (!in_array($name = $data->name, $files2)) {
				if ($data->type == 'dir') {
					$dirs[$name] = $dataSet;
				} else {
					$files[$name] = $dataSet;
				}
			}
		}
		ksort($dirs);
		ksort($files);
		return [$dirs, $files];
	}

	// post action
	function action () {
		$sql = $add_sql = $column = $msg = $url = "";
		$param = $this->param;
		$cancel = "idx/confirm/action/";
		extract($_POST);
		$table = 'project';
		switch ($action) {
			case 'insert' :
				// $this->query("
				// 	TRUNCATE TABLE `project`;
				// 	TRUNCATE TABLE `file`;
				// 	TRUNCATE TABLE `project_version`;
				// ");
				// 누락된 항목 검사
				$len = strlen($title)+strlen($description);
				access($len, "누락된 항목이 있습니다.");

				// 파일 업로드 상태 검사
				$file = $_FILES['project'];
				access(is_uploaded_file($file['tmp_name']), "파일을 업로드해주세요");

				// 압축 파일인지 검사
				$ext = getExt($file['name']);
				access($ext == 'zip', "압축 파일만 업로드할 수 있습니다.");

				// 이미 등록된 프로젝트인지 검사
				$cnt = $this->rowCount("SELECT * FROM project where member = '{$param->member->idx}' and title = '{$title}'");
				access($cnt == 0, "이미 등록된 프로젝트 입니다.");

				// 일단 추가 DB에 추가
				$_POST['member'] = $param->member->idx;
				$_POST['version'] = 1;
				$add_sql .= ", date = now()";
				$column = $this->getColumn($_POST, $cancel).$add_sql;
				if ($this->query_action($action, $table, $column)) {
					// zip 파일 업로드
					$idx = $this->projectId = $this->lastId;
					$file_name = $this ->lastId.".{$ext}";
					$zipDir = _UPDIR."/{$idx}";
					mkdir($zipDir);
					if(move_uploaded_file($file['tmp_name'], $zipPath = "{$zipDir}/common.{$ext}")){
						$zip = new ZipArchive();
						// 압축 해제
						if ($zip->open($zipPath) === true) {
							$commonDir = $zipDir."/1";
							mkdir($commonDir);
							$zip->extractTo($commonDir);
							$zip->close();
							unlink($zipPath);
							// DB에 프로젝트 파일 등록
							$commonURI = getURI($commonDir);
							$this->query("
								INSERT INTO file SET
								name='{$title}',
								parent=0,
								project='{$this->projectId}',
								uri='{$commonURI}',
								type='dir',
								version='1';
							");
							$lastId = $this->lastId;
							$this->query("
								INSERT INTO project_version SET
								title='{$title}',
								project='{$this->projectId}',
								description='{$description}',
								root='{$lastId}',
								version='1';
							");
							$this->insertFileList($commonDir, $lastId);
							alert('프로젝트가 등록되었습니다.');
							move();
						}
					}
				} else {
					alert('에러!');
					move();
				}
				exit;
			break;
			case 'delete' :
				$this->sql = "SELECT * FROM file where idx = '{$param->idx}'";
				$data = $this->fetch();
				unlink(_ROOT.$data->uri);
				$action = "update";
				$table = "file";
				$_POST['state'] = 0;
				$add_sql = " where idx = '{$param->idx}';";
				$msg = "파일이 삭제되었습니다.";
				$url = $param->get_page."/view/{$data->project}/{$data->version}/{$data->parent}";
			break;
			case 'version_insert' :
				$table = 'project_version';
				$action = 'insert';
				$before_ver = $param->version;
				$ver = $this->fetch("SELECT max(version)+1 as version FROM project_version where project='{$param->idx}'")->version;
				$_POST['version'] = $ver;
				$_POST['project'] = $param->idx;
				$column = $this->getColumn($_POST, $cancel);
				if($this->query_action($action, $table, $column.$add_sql)){
					$verId = $this->lastId;
					$before = _UPDIR."/{$param->idx}/".$before_ver;
					$after = _UPDIR."/{$param->idx}/".$ver;
					copyDir($before, $after);
					// DB에 파일 등록
					$uri = getURI($after);
					$this->projectId = $param->idx;
					$this->query("
						INSERT INTO file SET
						name='{$title}',
						parent=0,
						project='{$this->projectId}',
						uri='{$uri}',
						type='dir',
						version='{$ver}';
					");
					$this->query("UPDATE project SET version = '{$_POST['version']}' where idx = '{$this->projectId}'");
					$this->query("UPDATE project_version SET root = '{$this->lastId}' where idx = '{$verId}'");
					$this->insertFileList($after, $rootId = $this->lastId, $ver);
					alert('완료되었습니다.');
					move($param->get_page."/view/{$this->projectId}/{$_POST['version']}/{$rootId}");
				} else {
					echo $sql;
				}
				exit;
			break;
			case 'file_multi_delete' :
				$idx = $_POST['idx'];
				do {
					$len = count($idx);
					$idx = implode(',', $idx);
					$list = $this->fetchAll("SELECT * FROM file where parent in ({$idx}) or idx in ({$idx})");
					if($len == count($list)) break;
					$idx = [];
					foreach ($list as $data) $idx[] = $data->idx;
				} while (true);
				//print_pre($idx);
				$dir_list = $this->fetchAll("SELECT * FROM file where idx in ({$idx}) and type = 'dir' order by idx asc");
				$file_list = $this->fetchAll("SELECT * FROM file where idx in ({$idx}) and type = 'file' order by idx asc");
				foreach ($file_list as $file) @unlink(_ROOT.$file->uri);
				foreach ($dir_list as $dir) @rmdir(_ROOT.$dir->uri);
				$this->query("UPDATE file SET state = 0 where idx in ({$idx})");
				alert('완료되었습니다.');
				move();
				exit;
			break;
		}
		$column = $this->getColumn($_POST, $cancel);
		if($this->query_action($action, $table, $column.$add_sql)){
			alert($msg);
			move($url);
		} else {
			echo $sql;
		}
		exit;
	}

	// 폴더에 있는 파일 목록을 DB에 추가
	function insertFileList ($dir, $parent, $ver = 1) {

		// 핸들 획득
		$handle  = opendir($dir);

		// 디렉터리에 포함된 파일을 저장한다.
		while (false !== ($filename = readdir($handle))) {

			if(in_array($filename, ['.', '..'])) continue;

	        $path = $dir."/{$filename}";
	        $uri = getURI($path);
	        $type = filetype($dir."/{$filename}");

	        $this->sql = "
				INSERT INTO file SET
				`project` = '{$this->projectId}',
				`parent` = '{$parent}',
				`name` = '{$filename}',
				`uri` = '{$uri}',
				`type` = '{$type}',
				`version` = '{$ver}'
			";
			$this->query();

			// project icon 설정
			if (preg_match("/project\-icon\.(jpg|jpeg|png)/", $filename)) {
				$this->sql = "
					UPDATE project SET
					`icon` = '{$this->lastId}'
					where `idx` = '{$this->projectId}';
				";
				$this->query();
			}

			// 디렉토리일 경우 재귀 호출
			if($type == 'dir') {
				$this->insertFileList($dir."/{$filename}", $this->lastId, $ver);
			}
		}

		// 핸들 해제 
		closedir($handle);
	}
}