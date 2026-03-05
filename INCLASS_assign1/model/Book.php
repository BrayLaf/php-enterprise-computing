<?php 
    class Book{
        private $conn;
        public $id;
        public $Title;
        public $Author;
        public $Description;


        public function __construct($database)
        {
            $this->conn = $database;
        }

        public function GetBooks(){
            $query = "SELECT * FROM books";
            return $this->conn->query($query);
        }

        public function CreateBook(){
            $query = "INSERT INTO books (title, author, description) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sss", $this->Title, $this->Author, $this->Description);
            
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