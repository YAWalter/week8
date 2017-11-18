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
		// variables:
		// foo::bar($foobar);
		// begin building output 
		
	}
	
	public function __destruct() {
		// echo $this->html;
	}
}

// ## NO OTHER CLASSES SHOULD REMAIN HERE

// ## COLLECTIONS:	class table extends collection { protected static $modelname = 'table'; }
// ## MODELS: 		class table extends model { public $column; } plus a __construct()er, where $this->tableName = 'tableName';


// this would be the method to put in the index page for accounts
$records = accounts::findAll();
//print_r($records);
// this would be the method to put in the index page for todos
$records = todos::findAll();
//print_r($records);
//this code is used to get one record and is used for showing one record or updating one record
$record = todos::findOne(1);
//print_r($record);
//this is used to save the record or update it (if you know how to make update work and insert)
// $record->save();
//$record = accounts::findOne(1);
//This is how you would save a new todo item
$record = new todo();
$record->message = 'some task';
$record->isdone = 0;
//$record->save();

// sample output:
print_r($record);
echo '<br>';
$record = todos::create();
print_r($record);

?>
