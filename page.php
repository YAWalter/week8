<?php

// a page has no name...
abstract class page {
	protected $html;

	public function __construct() {
		$this->html = pageBuild::PageHeader();
	}
    
	public function __destruct() {
		$this->html .= pageBuild::pageEnder();
		echo $this->html;
	}

	public function get() {
		echo 'default get message';
	}

	public function post() {
		//print_r($_POST);
	}
}

// index.php?page=homepage
class homepage extends page {
	public function get() {
		$this->html .= htmlTags::formBuild();
	}
	
	public function post() {
		// some environment variables
		$name = $_FILES['fileToUpload']['name'];
		$tmp_name = $_FILES['fileToUpload']['tmp_name'];
		$filedata = pageBuild::filepath();
		$resource = $filedata['upload'] . $name;
		
		if ($name) {
			//$this->html .= 'uploading file to: ' . $resource;
			//$this->html .= htmlTags::lineBreak();
			if (move_uploaded_file($tmp_name, $resource)) {
				$this->html .= 'SUCCESS';
				// set the header redirect
				header(pageBuild::redirect('CSVdisplay', $name));
		
			} else {
				$this->html .= 'FAILURE ' . $_FILES['fileToUpload']['error'];
			}
		}
			
		// print error message, because you should be gone by now...
		$this->html .= htmlTags::heading('WHY ARE YOU HERE?!');
	}
}

// index.php?page=read
class read extends page {
	public function get() {
		// get table
		$table = pageBuild::getParam('table');
		$id = pageBuild::getParam('id');
		
		// if no $id specified, findAll();
		if ($id == NULL) {
			echo htmlTags::heading('Find all ' . $table . ':');
			$records = $table::findAll();
		} else {
			echo htmlTags::heading('Find id '. $id . ' from ' . $table . ':');
			$records = $table::findOne($id);
		}		
		
		echo htmlTags::preObj($records);
	}

}

?>