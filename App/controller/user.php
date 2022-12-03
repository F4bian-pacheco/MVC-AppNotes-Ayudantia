<?php 

require_once "model/user.php";


class userController{
    public $page_title;
    public $user;

    public function __construct(){
        $this->view = 'usuarios/listar_usuarios';
        $this->page_title = "User";
        $this->user = new User();
    }

    public function index(){
        $this->page_title = 'Listado de usuarios';
        $users = $this->user->getUsers();
        return $users;
    }

    public function editar(){
        $this->page_title = 'Editar usuario';
        $this->view = 'usuarios/listar_usuarios';
        $id = $_GET['id'];
        $user = $this->user->getUser($id);
        return $user;
    }

    public function guardar(){
        $this->page_title = "Guardar usuario";
        $this->view = "usuarios/listar_usuarios";
        // print_r($_POST);
        if (isset($_POST["id"]) && $_POST["id"] != "") {
            $mensaje = $this->user->update($_POST);
        } else {
            // $_POST["pass"] = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            $mensaje = $this->user->crear($_POST);
        }
        return $mensaje;
    }

    public function eliminar(){
        $this->page_title = "Eliminar usuario";
        $this->view = "usuarios/listar_usuarios";
        $id = $_GET["id"];
        $mensaje = $this->user->delete($id);
        $_GET["response"] = $mensaje;
        return $mensaje;
    }
}


?>