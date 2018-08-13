<?php
	Class FileController extends Controller {

		function file(){
			$this->getRouteName();
			$this->dir_list = $this->model->getDirList();
			$this->file_list = $this->model->getFileList();
			$this->path = 0;
			$this->parentURL = NULL;
			$this->path_data = $this->model->getPath();
			if($this->path_data){
				$this->path = $this->path_data->idx;
				$this->parentURL = HOME_URL."/file?path={$this->path_data->parent}";
			}
		}

		function dir_add(){
			$this->getRouteName();
		}

		function update(){
			$this->getRouteName();
			$this->data = $this->model->getFile();
			if($this->data->type != 'path'){
				$ext = explode(".",$this->data->com_name);
				$ext = array_pop($ext);
				$this->ext = $ext;
				$this->data->com_name = str_replace(".{$ext}","",$this->data->com_name);
			}
		}

		function deletePath(){
			$this->model->setDeletePath();
			exit;
		}

		function deleteFile(){
			$this->model->setDeleteFile();
			exit;
		}

		function getRouteName(){
			$this->path_name = $this->model->getPathName();
		}
	}