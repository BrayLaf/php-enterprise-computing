<?php 
    class User {
        private $conn;
        public $id;
        public $username;
        public $email;
        public $password;
        public function __construct($database)
        {
            $this->conn = $database;
        }

        public function Login(){
            $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                $user = $result->fetch_assoc();
                $storedPassword = $user['password'];

                if (password_verify($this->password, $storedPassword) || $this->password === $storedPassword) {
                    $this->id = $user['id'];
                    $stmt->close();
                    return true;
                }
            }
            $stmt->close();
            return false;
        }

        public function Register(){
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (username, email, password) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sss", $this->username, $this->email, $hashedPassword);
            
            if($stmt->execute()){
                $this->id = $this->conn->insert_id;
                $stmt->close();
                return true;
            }
            
            $stmt->close();
            return false;
        }
    }

?>