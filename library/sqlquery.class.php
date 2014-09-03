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


   
    public function selectAll($table)
    {

	    $sth = $this->_dbh->prepare('SELECT * FROM'.$table);
	    $sth->execute();
	    $result = $sth->fetchAll();
	    return $result;
    }

    public function select($id,$table)
    {
	    $sth = $this->_dbh->prepare('select * from'.$table.'where id ='.$id);
	    $sth->execute();
	    $result = $sth->fetchAll();
	    return $result;
    }
}
    /** Custom sql query **/
    
/**    public function query($query)
    {
	    $sth = $this->_dbh->prepare($query);
    	    $sth->execute();
	    $result = $sth->fetchAll();
	    return $result;
    }
}
**/
