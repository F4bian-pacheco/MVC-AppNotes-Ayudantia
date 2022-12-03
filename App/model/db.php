
<?php 

require_once "config/config.php";

class Db{

    private $host;
    private $user;
    private $pass;

    public function __construct()
    {   
        $this->host = constant('DB_HOST');
        $this->user = constant('DB_USER');
        $this->pass = constant('DB_PASS');
        $this->conn = oci_connect($this->user, $this->pass, $this->host);

        if(!$this->conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

    }

    public function close(){
        oci_close($this->conn);
    }

}


?>