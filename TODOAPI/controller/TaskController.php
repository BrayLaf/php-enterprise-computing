<?php
include "model/Task.php";
include "config/DB.php";

class TaskController{
    private $taskModel;

    public function __construct(){
        $database = new DB();
        $db= $database->connect();
        $this->taskModel = new Task($db);
    }
    public function addTask(){
        // send by the raw body of the HTTP request.
        $jsonData = file_get_contents("php://input");
        // true: convert json data to associative array, false: convert json data to object
        $data = json_decode($jsonData, true);
        $this->taskModel->task = $data['task'];
        $result = $this->taskModel->create(); 
        if($result){
            echo json_encode(["task"=>$data["task"]]);
        }else{
            echo json_encode(["message"=>"Task not added"]);
        }
    }
    public function updateTask($id){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $this->taskModel->id = $id;
        $this->taskModel->is_completed = $data['is_completed'];

        $result = $this->taskModel->update();
        if($result){
            echo json_encode(["id"=>$id, "is_completed"=>$data["is_completed"]]);
          }else{
            echo json_encode(["message"=>"Task not updated"]);
        }
    }

    public function deleteTask($id){
        $this->taskModel->id = $id;
        $result = $this->taskModel->delete();
        if($result){
            echo json_encode(["message"=>"Task deleted"]);
        }else{
            echo json_encode(["message"=>"Task not deleted"]);
        }
    }
    public function index(){
        $tasks = $this->taskModel->read();
        // print_r($task);
        if($tasks->num_rows==0){
            // error
            echo json_encode(["message"=>"No tasks found"]);
        }else{
            $data = $tasks->fetch_all(MYSQLI_ASSOC);
            $jsonData = json_encode($data);
            echo $jsonData;
        }
    }
}