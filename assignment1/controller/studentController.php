<?php
include_once __DIR__ . "/../config/Database.php";
include_once __DIR__ . "/../model/student.php";
    
    class studentController{
        private $student;

        public function __construct($database = null)
        {
            if ($database === null) {
                $database = new Database();
            }
            $db = $database->connect();
            $this->student = new Student($db);
        }

        public function listStudents(){
            $students = $this->student->GetStudents();
            if(!$students || $students->num_rows === 0){
                return [];
            }
            return $students->fetch_all(MYSQLI_ASSOC);
        }

        public function createStudentFromForm($name, $email, $studentId){
            $this->student->Name = $name;
            $this->student->Email = $email;
            $this->student->studentId = $studentId;
            return $this->student->CreateStudent();
        }

        public function removeStudent($id){
            $this->student->id = (int)$id;
            return $this->student->DeleteStudent();
        }

        public function getStudents(){
            $students = $this->student->GetStudents();
            if($students->num_rows == 0){
                echo json_encode(["message"=>"No students found"]);
            }else{
                $data = $students->fetch_all(MYSQLI_ASSOC);
                $jsonData = json_encode($data);
                echo $jsonData;
            }
        }
        public function newStudent(){
            $jsonData = file_get_contents("php://input");

            $data = json_decode($jsonData, true);
            $this->student->Name = $data['name'];
            $this->student->Email = $data['email'];
            $this->student->studentId = $data['studentId'];
            $result = $this->student->CreateStudent();
            echo json_encode(["message"=>$result ? "Student created successfully, id " . $this->student->id : "Failed to create student"]);   
        }
        public function deleteStudent($id){
            $this->student->id = $id;
            $result = $this->student->DeleteStudent();
            echo json_encode(["message"=>$result ? "Student deleted successfully" : "Failed to delete student"]);   
        }
      
    }

?>