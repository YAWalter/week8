<?php

abstract class model {
    protected $tableName;
    public function save()
    {
        $tableName = get_called_class();
        $array = get_object_vars($this);
	   
	   $columns = array_flip($array);
	   array_pop($columns);
        $columnString = implode(',', $columns);
        
	   $values = array_slice($array, 1);
	   array_pop($values);
	   $valueString = implode(',', $values);
	   
	   echo htmlTags::preObj($this);
	   echo $tableName . 'CHECK' . htmlTags::lineBreak();
	   echo $columnString . htmlTags::lineBreak();
	   echo $valueString . htmlTags::lineBreak() . htmlTags::lineBreak();
	   
        if ($this->id == '') {
            $sql = $this->insert($tableName, $columnString, $valueString);
        } else {
            $sql = $this->update();
        }
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->execute();
       
        echo 'I just saved record: ' . $this->id;
    }
	
    private function insert($tableName, $columnString, $valueString) {
        $sql = 'INSERT INTO ' . $tableName . 
			's (' . $columnString . ') VALUES (' . $valueString. ')';
        
	   echo $sql . htmlTags::lineBreak();
	   return $sql;
    }
	
    private function update() {
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