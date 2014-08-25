<?php

class SQLQuery {
    protected $_result;
    protected $_dbh;
    /** Connects to database **/

    public function connect($host, $user, $pass, $dbname)
    {
	    try {
		   $this->_dbh = new PDO ("mysql: host= $host;dbname=$dbname", $user, $pass);
		    $this->_dbh->exec('SET NAMES utf8');	
		    echo 'Connected to database'.PHP_EOL;
	    }
	    	
	    catch (PDOException $e)
	    {
		    echo $e->getMessage();
		    echo 'Cannot connect to database'.PHP_EOL;
	    }
    }

    public function disconnect()
    {
	    $this->_dbh=null;
    }

}
    /**
   
    public function selectAll()
    {
	    $query = 'select * from'.$this->table;
	    return ($this->query($query));

    }

    public function select($id)
    {
	    $query = 'select * from'.$this->table.'where id ='.mysql_real_escape_string($id);
	    return ($this->query($query));
    }


    /** Custom sql query **/
    
 /**   public function query($query, $SingleResult=0)
    {

    **/	    
