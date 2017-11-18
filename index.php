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

// ## OTHER CLASSES GO HERE
//    try to keep everything in alpha order, eh?

// ## COLLECTIONS (all that's needed is the below templtate)
//    class table extends collection { protected static $modelname = 'table'; }
class accounts extends collection {
    protected static $modelName = 'account';
}
class todos extends collection {
    protected static $modelName = 'todo';
}

// ## MODELS (add the __construct()er, too, to build $this->tableName)
//    class table extends model { public $column; }
class account extends model {
}

class todo extends model {
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;
    public function __construct()
    {
        $this->tableName = 'todos';
	
    }
}

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
