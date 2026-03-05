<?php 
include_once __DIR__ . "/../config/Database.php";
include_once __DIR__ . "/../model/user.php";

    class userController{
        private $user;

        public function __construct($database)
        {
            $this->user = new User($database->connect());
        }
        public function Login($email, $password){
            $this->user->email = $email;
            $this->user->password = $password;
            return $this->user->Login();
        }
        public function Register($username, $email, $password){
            $this->user->username = $username;
            $this->user->email = $email;
            $this->user->password = $password;
            return $this->user->Register();
        }
    }

?>