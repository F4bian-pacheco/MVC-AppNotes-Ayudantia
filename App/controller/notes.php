<?php 
require_once "model/notes.php";

class notesController{

    public $page_title; // opcional
    public $noteObj;
    public $view;

    public function __construct()
    {
        $this->view = "notas/listar_nota";
        $this->noteObj = new Note();
    }

    public function index(){
        $this->page_title = "Notas";
        return $this->noteObj->getNotes();
    }

    public function editar(){
        $this->view = "notas/listar_nota";
        $id = $_GET["id"];
        return $this->noteObj->getNoteById($id);
    }

    public function guardar(){
        $this->page_title = "Guardar nota";
        $this->view = "notas/listar_nota";

        // print_r($_POST);
        if(isset($_POST["id"]) && $_POST["id"] != ""){
            $mensaje = $this->noteObj->update($_POST);
        }else{
            $mensaje = $this->noteObj->crear($_POST);
        }
        return $mensaje;
    }

    public function borrar(){
        $this->page_title = "Eliminar nota";
        $this->view = "notas/listar_nota";
        $id = $_GET["id"];
        $mensaje = $this->noteObj->eliminar($id);
        return $mensaje;
    }

}


?>