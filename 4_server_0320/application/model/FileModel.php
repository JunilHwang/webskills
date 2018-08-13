<?php
	class FileModel extends Model {

		//getFileList
		function getFileList(){
			$path = isset($_GET['path']) ? $_GET['path'] : 0;
			$this->sql = "SELECT * FROM files where type != 'path' and parent='{$path}';";
			return $this->fetchAll();
		}

		//getDirList
		function getDirList(){
			$path = isset($_GET['path']) ? $_GET['path'] : 0;
			$this->sql = "SELECT * FROM files where type = 'path' and parent='{$path}';";
			return $this->fetchAll();
		}

		//getPathName
		function getPathName(){
			$path = isset($_GET['path']) ? $_GET['path'] : 0;
			$root = '<a href="'.HOME_URL.'/file">root</a>';
			$path_name = $root;
			if($path == 0){
				return $path_name;
			} else {
				$this->sql = "SELECT * FROM files where type='path' and idx = '{$path}'";
				$data = $this->fetch();
				$path_name = $data->com_name;
				while($data){
					$this->sql = "SELECT * FROM files where type='path' and idx = '{$data->parent}'";
					$data = $this->fetch();
					if($data){
						$link = HOME_URL."/file?path={$data->idx}";
						$path_name = "<a href=\"{$link}\">{$data->com_name}<a/> &gt; {$path_name}";
					}
				}
				return "{$root} &gt; {$path_name}";
			}
		}

		//getPath
		function getPath(){
			if(!isset($_GET['path']) || $_GET['path'] == 0) return 0;
			$this->sql = "SELECT * FROM files where idx='{$_GET['path']}';";
			return $this->fetch();
		}

		//getFile
		function getFile(){
			$this->sql = "SELECT * FROM files where idx='{$this->cr->param->idx}'";
			return $this->fetch();
		}

		//deletePath
		function setDeletePath(){
			$param = $this->getParam();
			$idxs = $parent = [];
			$list = $this->fetchAll("SELECT idx FROM files where parent='{$param->idx}'");
			foreach($list as $data) $parent[] = $data->idx;
			$idxs = $parent;
			while(isset($parent[0])){
				$parent = implode(",",$parent);
				$child_list = $this->fetchAll("SELECT idx FROM files where parent in ($parent)");
				$parent = [];
				foreach($child_list as $data){
					$idxs[] = $data->idx;
					$parent[] = $data->idx;
				}
			}
			$idxs[] = $param->idx;
			$idxs = implode(",",$idxs);
			$file_list = $this->fetchAll("SELECT * FROM files where idx in ({$idxs}) and type != 'path';");
			foreach($file_list as $data){
				@unlink(DATA_PATH."/{$data->change_name}");
			}
			$this->sql = "DELETE FROM files where idx in ({$idxs})";
			$this->query();
			alert("삭제 되었습니다.");
			move();
		}	

		//deleteFile
		function setDeleteFile(){
			$param = $this->getParam();
			$data = $this->fetch("SELECT change_name FROM files where idx='{$param->idx}'");
			@unlink(DATA_PATH."/{$data->change_name}");
			$this->sql = "DELETE FROM files where idx='{$param->idx}'";
			$this->query();
			alert("삭제 되었습니다.");
			move();
		}

		//action
		function action(){
			extract($_POST);
			$add_sql = "";
			$msg = "완료되었습니다.";
			$url = HOME_URL."/file";
			$param = $this->getParam();
			$member = $this->getMemberInfo();
			$path = isset($_GET['path']) ? $_GET['path'] : 0;
			switch($action){
				case 'dir_add' :
					$this->sql = "SELECT * FROM files where com_name = '{$com_name}' and parent='{$path}';";
					access($this->rowCount() == 0,"같은 디렉토리에 중복된 이름이 있습니다.");
					$this->sql = "
						INSERT INTO files SET
						parent='{$path}',
						midx='{$member->idx}',
						com_name='{$com_name}',
						create_date=now(),
						change_date=now(),
						type='path';
					";
					$url .= "?path={$path}";
				break;
				case 'update' : 
					if(isset($ext)){
						$com_name .= $ext;
					}
					$this->sql = "
						UPDATE files SET
						com_name = '{$com_name}',
						change_date = now()
						where idx='{$param->idx}';
					";
				break;
				case 'file_upload' :
					$file = $_FILES['file'];
					access(is_uploaded_file($file['tmp_name']),"업로드된 파일이 없습니다.");
					$change_name = file_upload($file);
					$path = isset($_GET['path']) ? $_GET['path'] : 0;
					$this->sql = "
						INSERT INTO files SET
						com_name='{$file['name']}',
						midx='{$member->idx}',
						change_name='{$change_name}',
						create_date=now(),
						change_date=now(),
						parent='{$path}',
						type='file',
						size='{$file['size']}';
					";
					$url = false;
				break;
			}
			$res = $this->query();
			if($res){
				alert($msg);
				move($url);
			}
		}
	}