<?php 
include "model/Book.php";
include "config/Database.php";

    class BookController{
        private $BookModel;

        public function __construct()
        {
            $database = new Database();
            $db = $database->connect();
            $this->BookModel = new Book($db);
        }

        public function getBooks(){
            $books = $this->BookModel->GetBooks();
            if($books->num_rows == 0){
                echo json_encode(["message"=>"No books found"]);
            }else{
                $data = $books->fetch_all(MYSQLI_ASSOC);
                $jsonData = json_encode($data);
                echo $jsonData;
            }
        }

        public function newBook(){
            $jsonData = file_get_contents("php://input");

            $data = json_decode($jsonData, true);
            $this->BookModel->Title = $data['title'];
            $this->BookModel->Author = $data['author'];
            $this->BookModel->Description = $data['description'];
            $result = $this->BookModel->CreateBook();
            echo json_encode(["message"=>$result ? "Book created successfully, id " . $this->BookModel->id : "Failed to create book"]);   
        }
    }

?>