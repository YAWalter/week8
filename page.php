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
		// something about the available tables
		$this->html .= htmlTags::heading('WHY ARE YOU HERE?!');
	}
	
	public function post() {
		// something about whatever was just added
		// print error message, because you should be gone by now...
		$this->html .= htmlTags::heading('WHY ARE YOU HERE?!');
	}
}

// index.php?page=create
class create extends page {
	public function get() {
		// get table
		$table = pageBuild::getParam('table');
		
		$this->html .= htmlTags::formBuild($table, get_class());
	}

	public function post() {
		// debug $_POST
		echo htmlTags::preObj($_POST);
		//This is how you would save a new todo item
		$table = pageBuild::getParam('table');
		
		$record = $table::create();

		$record->email = $_POST['email'];
		$record->fname = $_POST['fname'];
		$record->lname = $_POST['lname'];
		$record->phone = $_POST['phone'];
		$record->birthday = $_POST['birthday'];
		$record->gender = $_POST['gender'];
		$record->password = $_POST['password'];
		
		//$record->message = 'some task';
		//$record->isdone = 0;
		$record->save();
		echo htmlTags::preObj($record);
	}
}

// index.php?page=read
class read extends page {
	public function get() {
		// get params
		$table = pageBuild::getParam('table');
		$id = pageBuild::getParam('id');
		
		if ($id == NULL) {
			// if no $id specified, findAll();
			$this->html .= htmlTags::heading('Find all ' . $table . ':');
			$records = $table::findAll();
		} else {
			// otherwise, find by ID
			$this->html .= htmlTags::heading('Find id '. $id . ' from ' . $table . ':');
			$records = $table::findOne($id);
		}		
		
		$this->html .= htmlTags::preObj($records);
	}
}

// index.php?page=update
class update extends page {
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

	public function post() {
		//method for updating one record
	}
}

// index.php?page=remove
class remove extends page {
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