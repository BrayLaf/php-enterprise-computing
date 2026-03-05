<?php 
    class Student{
        private $conn;
        public $id;
        public $Name;
        public $Email;
        public $studentId;
    

        public function __construct($database)
        {
            $this->conn = $database;
        }

        // read student information
        public function GetStudents(){
            $query = "SELECT * FROM students";
            return $this->conn->query($query);
        }

        // create new student 
        public function CreateStudent(){
            $query = "INSERT INTO students (name, email, studentId) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sss", $this->Name, $this->Email, $this->studentId);
            
            if($stmt->execute()){
                $this->id = $this->conn->insert_id;
                $stmt->close();
                return true;
            }
            
            $stmt->close();
            return false;
        }
        //delete student

        public function DeleteStudent(){
            $query = "DELETE FROM students WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $this->id);
            
            if($stmt->execute()){
                $stmt->close();
                return true;
            }
            
            $stmt->close();
            return false;
        }
    }
?>