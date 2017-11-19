<?php

abstract class model {
    protected $tableName;
    public function save()
    {
        if ($this->id = '') {
            $sql = $this->insert();
        } else {
            $sql = $this->update();
        }
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->execute();
        $tableName = get_called_class();
        $array = get_object_vars($this);
        $columnString = implode(',', $array);
        $valueString = ":".implode(',:', $array);
       
        echo 'I just saved record: ' . $this->id;
    }
	
    private function insert() {
        $sql = 'INSERT INTO ' . $tableName . ' (' . $columnString . ') VALUES (' . $valueString. ')';
        
	   echo $sql . htmlTags::lineBreak;
	   return $sql;
    }
	
    private function update() {
	    // this may need fixing
        $sql = 'UPDATE ' . $tableName .
			'SET ' . $columnString . '=' . $valueString .
			'WHERE id=' . $this->id;
	   
        echo $sql . htmlTags::lineBreak;
        echo 'I just updated record' . $this->id;
	   return $sql;
    }
	
    public function delete() {
	   $sql = 'DELETE FROM ' . $tablename . ' WHERE id=' . $this->id;
	   
	   echo $sql . htmlTags::lineBreak;
        echo 'I just deleted record' . $this->id;
	   return $sql;
    }
}

?>