<?php 
class Database{
    protected $connection;
    protected $query;
    protected $cdata = 0;
    
    var $dbhost = 'localhost';
    var $dbuser = 'root';
    var $dbpass = '';
    var $dbname = 'db_HRD';
    var $dbcharset = 'utf8';

	public function __construct() {
		$this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        
        if ($this->connection->connect_error) {
			die('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
        
		$this->connection->set_charset($this->dbcharset);
	}
	
    public function query($query) {
		if ($this->query = $this->connection->prepare($query)) {
            
            $this->query->execute();
               
            if ($this->query->errno) {
				die('Unable to process MySQL query (check your params) - ' . $this->query->error);
            }  
        } else {
            die('Unable to prepare statement (check your syntax) - ' . $this->connection->error);
        }
    }

    public function getList($query) {
		if ($this->query = $this->connection->prepare($query)) {
            
            $this->query->execute();
            $result =  $this->query->get_result();
               
            if ($this->query->errno) {
				die('Unable to process MySQL query (check your params) - ' . $this->query->error);
            }else{
                $parameters = array();
                
                while ($row = $result->fetch_array()) {
                  $parameters[] = $row;
                }
                
                return $parameters;
            }
        } else {
            die('Unable to prepare statement (check your syntax) - ' . $this->connection->error);
        }
    }

	public function close() {
		return $this->connection->close();
	}
}