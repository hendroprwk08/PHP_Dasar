<?php 
class Database{
    protected $mysqli;
    
    var $dbhost = 'localhost';
    var $dbuser = 'root';
    var $dbpass = '';
    var $dbname = 'db_HRD';

    /*
     * 1. koneksi ke mysql.
     * 2. eksekusi untuk insert, update dan delete.
     * 3. ambil data berupa array.
     * 4. tutup koneksi.
     */
    
    public function __construct() {
        #1. koneksi ke mysql
        try {
            $this->mysqli = new mysqli( 
                                $this->dbhost,
                                $this->dbuser,
                                $this->dbpass,
                                $this->dbname );
        }catch (\Exception $e){
            die('Error: '. $e->getMessage());
        }
    }
	
    public function exec( $q ){
        try{
            $this->mysqli->query( $q );
            return true;
        }catch (\Exception $e){
            die('Error: '. $e->getMessage());
            return false;
        }
    }

    public function getList( $q ) {
        try{
            $hasil = $this->mysqli->query( $q );
            if ( $hasil->num_rows > 0 ): #jika jumlah data > 0
                #konversi ke array
                while ($row = $hasil->fetch_array()) {
                    $rows[] = $row;
                }
            else:
                return array();
            endif;
            
            return $rows;
        }catch (\Exception $e){
             die('Error: '. $e->getMessage());
        }
    }

    public function close() {
        try{
            return $this->mysqli->close();
        }catch (\Exception $e){
            die('Error: '. $e->getMessage());
            return false;
        }
    }
}