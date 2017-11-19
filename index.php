<?php

// # DEBUGGING & AUTOLOADER
include 'debug.php'; 	// comment out when done!
include 'autoload.php';

include 'dbVars.php';

// # INSTANTIATE PROGRAM OBJECT
$obj = new main();

class main {
	
	private $html; 	// for output string
	
	public function __construct() {
		// begin building output 
		
		// ## PAGE NAME from 'page' param (default = 'homepage')
		$pageRequest = pageBuild::getName();
		
		$page = new $pageRequest;

		if($_SERVER['REQUEST_METHOD'] == 'GET') {
			$page->get();
		} else {
			$page->post();
		}
	}
	
	public function __destruct() {
		// echo $this->html;
	}
}

// ## NO OTHER CLASSES SHOULD REMAIN HERE

// ## COLLECTIONS.php:	class table extends collection { protected static $modelname = 'table'; }
// ## MODELS.php: 		class table extends model { public $column; } plus a __construct()er, where $this->tableName = 'tableName';


/*
TODOS:
-page chooser (params: table, operation, id)
*/


//this is used to save the record or update it (if you know how to make update work and insert)

echo htmlTags::heading('C');

// $record->save();
//$record = accounts::findOne(1);
//This is how you would save a new todo item
$record = new todo();
$record->message = 'some task';
$record->isdone = 0;
//$record->save();

echo htmlTags::heading('R');
// link? to accounts
// link? to todos


//this code is used to get one record and is used for showing one record or updating one record
$record = todos::findOne(1);
echo htmlTags::heading('Find one todo');
print_r($record);
echo htmlTags::lineBreak() . htmlTags::lineBreak();



// SAMPLES - REMOVE
echo htmlTags::lineBreak();
echo htmlTags::pre('SAMPLE OUTPUT:');
echo htmlTags::preObj($record);

$record = todos::create();
echo htmlTags::preObj($record);

?>
