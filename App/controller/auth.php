<?php 

require_once "model/user.php";


class authController{
    public $user;


    public function __construct()
    {
        $this->user = new User();
    }

    public function index(){
        $this->view = "login";
    }

    public function login(){

        $user = $this->user->verify_user($_POST["username"], $_POST["pass"]);
        if(count($user) > 0){
            session_start();
            print_r($user);
            $_SESSION["user"] = $user[0]["USERNAME"];
            $_SESSION["id_user"] = $user[0]["ID"];
            $_SESSION["rol"] = $user[0]["IDROL"];
            header("Location: /app/home");
        }else{
            header("Location: /app/auth?error=true");
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: /app/auth");
    }
}


?>