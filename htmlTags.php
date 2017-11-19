<?php

class htmlTags {	

	// ## SIMPLE ONES: <title>, <h1>, <br>, <pre>
	public static function makeTitle($str) {			
		return '<title>' . $str . '</title>';
	}
	
	public static function heading($str) {
		return '<h1>' . $str . '</h1>';
	}

	public static function lineBreak() {
			return '<br>';
	}
	
	public static function pre($str) {
		return '<pre>' . $str . '</pre>';
	}
	
	// like the above, but for arrays/objects
	public static function preObj($obj) {
		return htmlTags::pre(print_r($obj, true));
	}
	
	// ## listMaker: <ol> & <ul>
	public static function listMaker($arr, $ordered) {
		$list = htmlTags::listMaker($ordered, 0);
		foreach ($arr as $item) {
			$list .= '<li>' . $item . '</li>';
		}
		$list .= htmlTags::listMaker($ordered, 1);
		
		return $list;
	}
	
	private static function listTag($ordered, $close) {
		if ($ordered) {
			$type = 'ol';
		} else {
			$type = 'ul';
		}
		
		if ($close) {
			$close = '/';
		}
		
		return '<' . $close . $type . '>';
	}
	
	// ## form builder
	public static function formBuild($title = NULL) {
		$title = $title?:pageBuild::getName(true);
		$form  = '';//htmlTags::heading($title);
		
		$form .= '<form action="index.php?page=homepage" method="post" enctype="multipart/form-data">';
		
		// NEED TO BUILD URL: "index.php?page=" . pageBuild::getName() 
		
		$form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
		$form .= '<input type="submit" value="Upload CSV" name="submit">';
		$form .= '</form> ';
		
		return $form;
	}

}
?>
