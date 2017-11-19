<?php

// class for page tools
class pageBuild extends page {
	
	// adds "top matter": html, head, CSS, title, body and a page heading
	public static function pageHeader() {
		$name = pageBuild::getName(true);
		
		$head  = '<html><head>';
		$head .= '<link rel ="stylesheet" href="styles.css">';
		$head .= htmlTags::makeTitle($name);
		$head .= '</head><body>';
		$head .= htmlTags::heading($name);
		
		return $head; 
	}

	public static function getParam($param) {
		if(isset($_REQUEST[$param]))
			$value = $_REQUEST[$param];
		else
			$value = NULL;
		
		return $value;
	}
	
	public static function getName($upper = NULL) {
		$page = pageBuild::getParam('page') ? 
				pageBuild::getParam('page') : 
				'homepage';
		
		$page_case = $upper?ucwords($page):strtolower($page);
		
		return $page_case;
	}
	
	//is this necessary?
	public static function redirect($page, $file) {
		return 'Location: index.php?page=' . $page . '&file=' . $file;
	}
	
	public static function pageEnder() {
		return '</body></html>';
	}

}

?>