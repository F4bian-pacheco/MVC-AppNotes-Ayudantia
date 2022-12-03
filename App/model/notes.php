<?php 

class Note{

    private $tabla = 'NOTAS';
    private $connection;
    private $dbObj;

    public function __construct()
    {
        $this->dbObj = new Db();
    }

    public function getConection(){
        $this->connection = $this->dbObj->conn;
    }

    public function closeConection(){
        $this->dbObj->close();
    }

    public function getNotes(){ 
        $this->getConection();
        // $sql = "SELECT * FROM ".$this->tabla;
        if($_SESSION["rol"] == "2"){
            $sql = "select n.id, n.title, n.content, n.id_user, u.username, u.idrol from notas n join users u on n.id_user = u.id";
        }else{
            $sql = "select n.id, n.title, n.content, n.id_user, u.username, u.idrol from notas n join users u on n.id_user = u.id where n.id_user = ".$_SESSION["id_user"];
        }

        $stid = oci_parse($this->connection, $sql);
        oci_execute($stid);

        $notas = array();
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
            $notas[] = $row;
        }

        $this->closeConection();
        return $notas;
    }

    public function getNoteById($id){
        if(!is_null($id)){
            $this->getConection();
            $sql = "SELECT * FROM ".$this->tabla." WHERE ID = ".$id;
            $stid = oci_parse($this->connection, $sql);
            oci_execute($stid);

            $nota = array();
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
                $nota[] = $row;
            }

            $this->closeConection();
            return $nota;
        }
    }

    public function crear($params){
        $this->getConection();
        $user_id = $_SESSION["id_user"];
        // echo $user_id;
        $sql = "BEGIN proce_notes(title_note_p => :title_note, content_note_p => :content_note, user_id_p=>:user_id, mensaje => :mensaje, mod_est =>'I'); END;";
        $stid = oci_parse($this->connection, $sql);

        oci_bind_by_name($stid, ':title_note', $params["title"]);
        oci_bind_by_name($stid, ':content_note', $params["content"]);
        oci_bind_by_name($stid, ':user_id', $user_id);
        oci_bind_by_name($stid, ':mensaje', $mensaje, 100);
        oci_execute($stid);

        $this->closeConection();

        return array("mensaje" => $mensaje);

    }

    public function update($params){
        $this->getConection();
        $sql = "BEGIN proce_notes(title_note_p => :title_note, content_note_p => :content_note, mensaje => :mensaje, mod_est =>'U', id_note_p => :id_note); END;";
        $stid = oci_parse($this->connection, $sql);

        oci_bind_by_name($stid, ':title_note', $params["title"]);
        oci_bind_by_name($stid, ':content_note', $params["content"]);
        oci_bind_by_name($stid, ':mensaje', $mensaje, 100);
        oci_bind_by_name($stid, ':id_note', $params["id"]);

        oci_execute($stid);

        $this->closeConection();

        return array("mensaje" => $mensaje);
    }

    public function eliminar($id){
        $this->getConection();
        $sql = "BEGIN proce_notes(mod_est =>'D', id_note_p => :id_note,mensaje => :mensaje); END;";
        $stid = oci_parse($this->connection, $sql);
        oci_bind_by_name($stid, ':mensaje', $mensaje, 100);
        oci_bind_by_name($stid, ':id_note', $id);

        oci_execute($stid);

        $this->closeConection();

        return array("mensaje" => $mensaje);
    }


}

?>