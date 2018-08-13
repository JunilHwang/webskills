<?php
	Class DownController extends Controller {

		function down(){
			$data = $this->model->getFile();
			$path = DATA_PATH."/{$data->change_name}";
			header("Pragma: public");
			header("Expires: 0");
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"{$data->com_name}\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: {$data->size}");
			ob_clean();
			flush();
			readfile($path);
			exit;
		}

		function share(){
			$data = $this->model->getShareFile();
			$path = DATA_PATH."/{$data->change_name}";
			header("Pragma: public");
			header("Expires: 0");
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"{$data->file_name}\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: {$data->file_size}");
			ob_clean();
			flush();
			readfile($path);
			exit;
		}

		function outShare(){
			$model = new DownModel([]);
			$data = $model->getOutShareFile();
			$path = DATA_PATH."/{$data->change_name}";
			header("Pragma: public");
			header("Expires: 0");
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"{$data->file_name}\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: {$data->file_size}");
			ob_clean();
			flush();
			readfile($path);
			exit;
		}
	}