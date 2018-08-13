<?php
class ProjectController extends Controller {

	var $fileList;
	var $parent;
	var $downURI;
	var $mainURI;
	var $currentURI;
	var $fileURI;
	var $projectTitle;
	var $isWriter;

	function view_header () {
		// variable
		$param = $this->param;
		$model = $this->model;
		$this->data = $data = $model->getData();
		$this->projectTitle = "{$data->writer}/{$data->title}";
		$this->mainURI = $param->get_page."/view/{$param->idx}/{$data->version}/{$data->root}";
		$this->versionList = $model->getVersionList();
	}

	function view () {
		// variable
		$this->view_header();
		$param = $this->param;
		$model = $this->model;
		$data = $this->data;

		// data set
		$this->fileList = $model->getFileList();
		if ($param->file != 0) {
			$this->parentIdx = $model->getParentDir();
		}

		// uri
		$this->downURI = "{$param->get_page}/down/{$param->idx}/{$param->version}/{$param->file}";
		$this->currentURI = "{$param->get_page}/view/{$param->idx}/{$param->version}";
		$this->fileURI = "{$param->get_page}/file_view/{$param->idx}/{$param->version}";
		$this->uploadURI = "{$param->get_page}/upload/{$param->idx}/{$param->version}/{$param->file}";
		$this->commitURI = "{$param->get_page}/commit/{$param->idx}/{$param->version}";
		$this->isWriter = $param->isMember && $param->member->idx == $data->member;
		$this->compare();
	}

	function compare () {
		$param = $this->param;
		$model = $this->model;
		if (isset($_POST['from']) && isset($_POST['to'])) {
			$data = $model->getData($_POST['to']);
			move("{$param->get_page}/view/{$param->idx}/{$_POST['to']}/{$data->root}?from={$_POST['from']}");
		}
		$compareTo = $param->version;
		$compareFrom = $param->compareFrom;
		$this->isCompare = isset($compareFrom);
		if ($this->isCompare) {
			access($compareFrom < $compareTo, "이전 > 이후 형태로 비교가 가능합니다. 다시 선택해주세요");
			$this->compareList = $model->getCompareList();
			$compareURI = "{{now_data}}?from={$param->compareFrom}&amp;compare_file={{compareFile}}";
			$this->dir_base = "{$this->currentURI}/{$compareURI}";
			$this->file_base = "{$this->fileURI}/{$compareURI}";
		}
	}

	function file_view () {
		// variable
		$this->view_header();
		$this->compare();
		$param = $this->param;
		$model = $this->model;
		$data = $this->data;
		$this->fileData = $fileData = $this->model->getFile();
		$this->filePath = str_replace("/public/upload/{$param->idx}/{$param->version}", "", $fileData->uri);
		$fileContent = fileToCode(_ROOT.$fileData->uri);
		if ($this->isCompare && isset($param->compareFile) && $param->compareFile != '') {
			$prevFileData = $this->model->getFile($param->compareFile);
			$path = _ROOT.$prevFileData->uri;
			$prev_content = fileToCode($path);
			if (isImagePath($path)) {
				$fileContent = "
					<p><strong>이전 이미지</strong></p>
					<p>{$prev_content}</p>
					<p><strong>현재 이미지</strong></p>
					<p>{$fileContent}</p>
				";
			} else {
				$diff_content = new Diff($prev_content, $fileContent);
				$fileContent = $diff_content->toString();
			}
		}
		$this->fileContent = $fileContent;
		$this->deleteURI = $param->get_page."/file_delete/{$param->file}";
	}

	function down () {
		$model = $this->model;
		$data = $model->getData();
		$dir = $model->getFile();
		$zipName = _UPDIR."/{$data->title}.{$data->version}.zip";
		$removePath = "/public/upload/{$data->idx}/{$data->version}";;
		zipCreate($dir->uri, $zipName, $removePath);
		exit;
	}

	function file_delete () {
		$_POST['action'] = "delete";
		$this->model->action();
	}

	function upload () {
		$param = $this->param;
		$this->actionURI = "{$param->get_page}/upload_compare/{$param->idx}/{$param->version}/{$param->file}";
	}

	function upload_compare () {
		// variable
		$param = $this->param;
		$model = $this->model;
		$file = $_FILES['file'];

		// required check
		access(is_uploaded_file($file['tmp_name']), "파일을 업르도해주세요");

		// file info 
		$dir = $model->getFile();
		$file_name = $file['name'];
		$tmp_file = _ROOT."{$dir->uri}/{$file['name']}.tmp";
		$this->uploadURI = "{$param->get_page}/real_upload/{$param->idx}/{$param->version}/{$param->file}?name=".urlencode($file_name);

		// file temp
		@unlink($tmp_file);
		move_uploaded_file($file['tmp_name'], $tmp_file);
		$this->data = $data = $model->getFileInPath($file_name);
		
		// file get content
		$fileURI = $dir->uri."/{$file['name']}";
		$this->fileURI = str_replace("/public/upload/{$param->idx}/{$param->version}", "", $fileURI);
		$content = fileToCode($tmp_file);
		// code diff
		if ($data != null) {
			$path = _ROOT.$data->uri;
			$prev_content = fileToCode($path);
			if (isImagePath($path)) {
				$content = "
					<p><strong>이전 이미지</strong></p>
					<p>{$prev_content}</p>
					<p><strong>현재 이미지</strong></p>
					<p>{$content}</p>
				";
			} else {
				$diff = new Diff($prev_content, $content);
				$content = $diff->toString();
			}
		}
		$this->content = $content;
	}

	function cancel () {
		$param = $this->param;
		$uri = _ROOT."/public/upload/{$param->idx}/{$param->version}".urldecode($_GET['uri']);
		@unlink($uri);
		alert('취소되었습니다.');
		move("{$param->get_page}/view/{$param->idx}/{$param->version}/{$param->file}");
	}

	function real_upload () {
		// variable set
		$param = $this->param;
		$model = $this->model;
		$file_name = $_GET['name'];
		$dir = $model->getFile();
		$fullName = _ROOT.$dir->uri."/{$file_name}";
		$fileData = $model->getFileInPath($file_name);

		// move file
		@unlink($fullName);
		rename($fullName.".tmp", $fullName);
		if ($fileData != null) {
			$model->deleteFile($fileData);
		}
		if ($model->insertFile($file_name, $dir->uri)) {
			alert('완료되었습니다.');
			move("{$param->get_page}/view/{$param->idx}/{$param->version}/{$param->file}");
		}
		exit;
	}

}