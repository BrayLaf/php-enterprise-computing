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
    public function addTask($task){
        $task = trim($task);
        if ($task === "") {
            $_SESSION["flash"] = [
                "text" => "Task text is required",
                "type" => "error"
            ];
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }
        $this->taskModel->task = $task;
        $result = $this->taskModel->create(); 
        if($result){
            $_SESSION["flash"] = [
                "text" => "Task added successfully",
                "type" => "success"
            ];

        }else{
            $_SESSION["flash"] = [
                "text" => "Failed to add task",
                "type" => "error"
            ];
        }
       header("Location:".$_SERVER['PHP_SELF']);
       exit;
    }
    public function updateTask($id, $is_completed){
        $this->taskModel->id = $id;
        $this->taskModel->is_completed = $is_completed;
        $this->taskModel->update();
        
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function deleteTask($id){
        $this->taskModel->id = $id;
        $result = $this->taskModel->delete();
        if($result){
            $_SESSION["flash"] = [
                "text" => "Task deleted successfully",
                "type" => "success"
            ];
        }else{
            $_SESSION["flash"] = [
                "text" => "Failed to delete task",
                "type" => "error"
            ];
        }
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function index(){
        $tasks = $this->taskModel->read();
        if($tasks->num_rows==0){
        }
        include "view/TaskView.php";
    }
}