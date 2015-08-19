<?php
include ("../../connection/phpmysqlconnect.php");

class crud

{
	var $table;
	var $column = array();
	var $value = array();
	function __construct($conn, $table_name, $column_array, $value_array)
	{
		$this->table = $table_name;
		$this->column = $column_array;
		$this->value = $value_array;
		$this->conn = $conn;
	} // end of constructor
	function insert()
	{
		$insert_table = $this->table;
		$insert_column = $this->column;
		$insert_value = $this->value;
		$conn = $this->conn;
		$count = count($insert_column);
		$insert_statement = 'INSERT INTO ' . $insert_table . ' (';
		for ($i = 0; $i < $count; $i++)
		{
			if ($i != ($count - 1))
			{
				$insert_statement.= $insert_column[$i] . ', ';
			}
			else
			{
				$insert_statement.= $insert_column[$i] . ') ';
			} // end of if-else
		} // end of for loop
		$insert_statement.= 'VALUES (';
		for ($i = 0; $i < $count; $i++)
		{
			if ($i != ($count - 1))
			{
				$insert_statement.= '?, ';
			}
			else
			{
				$insert_statement.= '?)';
			} // end of if-else
		} // end of for loop
		$query = $conn->prepare($insert_statement);
		$query->execute($insert_value);
	} // end of insert method
	function delete()
	{
		$delete_table = $this->table;
		$delete_column = $this->column;
		$delete_value = $this->value;
		$conn = $this->conn;
		$count = count($delete_column);
		$delete_statement = 'DELETE FROM ' . $delete_table . ' where ';
		for ($i = 0; $i < $count; $i++)
		{
			if ($i != ($count - 1))
			{
				$delete_statement.= $delete_column[$i] . '= ? and ';
			}
			else
			{
				$delete_statement.= $delete_column[$i] . '= ?';
			} // end of if-else
		} // end of for loop
		$query = $conn->prepare($delete_statement);
		$query->execute($delete_value);
	} // end of delete method
	
	function update( $condition_column , $condition_value )
	{
		$update_table = $this->table;
		$update_column = $this->column;
		$update_value = $this->value;
		$conn = $this->conn;
		$count = count($update_column);
		$count2 = count($condition_column);
		
		$update_statement = 'UPDATE ' . $update_table . ' SET ';
		for ($i = 0; $i < $count; $i++)
		{
			if ($i != ($count - 1))
			{
				$update_statement.= $update_column[$i] . '= ? , ';
			}
			else
			{
				$update_statement.= $update_column[$i] . '= ?';
			} // end of if-else
		} // end of for loop
		
		$update_statement.=' where ';
		
		for ($i = 0; $i < $count2; $i++)
		{
			if ($i != ($count2 - 1))
			{
				$update_statement.= $condition_column[$i] . '= ? and ';
			}
			else
			{
				$update_statement.= $condition_column[$i] . '= ?';
			} // end of if-else
		} // end of for loop
		
		$update_value=array_merge($update_value, $condition_value);
		$query = $conn->prepare($update_statement);
		$query->execute($update_value);
	}
} // end of class crud added 
// Abhishek Shetty
// Amey Sawant

?>