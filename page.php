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

// index.php?page=CSVdisplay
class CSVdisplay extends page {
	public function get() {
		$file = pageBuild::filepath();
		
		// if there's a file, parse it
		$csv = ($file['name'] != NULL) ? 
			parser::fileToCsv($file['path']) :
			array();
		// debug
		// $this->html .= htmlTags::pre(print_r($csv, true));
		
		$this->html .= pageBuild::filename($file['name']);
		$this->html .= htmlTable::tableBuild($csv);
	}
}

?>