<?php 

class User {
    private $table = 'USERS';
    private $conection;
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getConection(){
        $this->conection = $this->db->conn;
    }

    public function closeConection(){
        $this->db->close();
    }

    public function verify_user($user, $pass){
            $this->getConection();
            $sql = "SELECT * FROM $this->table WHERE USERNAME = '$user' and PASSWORD = '$pass'";
            $stid = oci_parse($this->conection, $sql);
            oci_execute($stid);
            $user = array();
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $user[] = $row;
            }
            $this->closeConection();
            return $user;
    }

    public function getUsers(){
        $this->getConection();
        $sql = "SELECT * FROM $this->table natural join ROL";
        
        $stid = oci_parse($this->conection, $sql);
        oci_execute($stid);
        $users = array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $users[] = $row;
        }
        $this->closeConection();
        return $users;
    }

    public function getUser($id) {
        $this->getConection();
        $sql = "SELECT * FROM $this->table WHERE ID = $id";
        $stid = oci_parse($this->conection, $sql);
        oci_execute($stid);
        $user = array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $user[] = $row;
        }
        $this->closeConection();
        return $user;
    }

    public function crear($data){
        $this->getConection();
        // $sql = "INSERT INTO $this->table (USERNAME, EMAIL, PASSWORD, IDROL) VALUES (:username, :email, :password, :rol_id)";
        $sql = "Begin proce_user(p_username => :username, p_password => :pass, p_email => :email, p_role => :rol_id, mod_est => 'I'); end;";
        $stid = oci_parse($this->conection, $sql);
        oci_bind_by_name($stid, ':username', $data['username']);
        oci_bind_by_name($stid, ':email', $data['email']);
        oci_bind_by_name($stid, ':pass', $data['pass']);
        oci_bind_by_name($stid, ':rol_id', $data['rol']);
        $result = oci_execute($stid);
        $this->closeConection();
        return true;

    }

    public function update($data){
        $this->getConection();
        $sql = "UPDATE $this->table SET USERNAME = :username, EMAIL = :email, PASSWORD = :password, IDROL = :rol_id WHERE ID = :id";
        // $sql = "Begin proce_user(p_id_user=>:id_user , p_username => :username, p_password => :pass, p_email => :email, p_role => :rol_id, mod_est => 'U'); end;";
        $stid = oci_parse($this->conection, $sql);
        oci_bind_by_name($stid, ':username', $data['username']);
        oci_bind_by_name($stid, ':email', $data['email']);
        oci_bind_by_name($stid, ':password', $data['pass']);
        oci_bind_by_name($stid, ':rol_id', $data['rol']);
        oci_bind_by_name($stid, ':id', $data['id']);
        $result = oci_execute($stid);
        $this->closeConection();
        return true;
    }

    public function delete($id){
        $this->getConection();
        $sql = "DELETE FROM $this->table WHERE ID = :id";
        $stid = oci_parse($this->conection, $sql);
        oci_bind_by_name($stid, ':id', $id);
        $result = oci_execute($stid);
        $this->closeConection();
        return true;

    }

}
