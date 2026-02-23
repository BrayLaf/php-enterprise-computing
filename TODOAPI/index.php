<?php
include "controller/TaskController.php";

$controller = new TaskController();

$requestUri = $_SERVER['REQUEST_URI'];
// trim: remove the leading and trailing slashes from the string
// explode: split the string into an array using the delimiter "/"
$request = explode("/", trim($requestUri, "/")); 


// GET  /                ----> get all tasks
// POST /task            ----> add a new task
// PUT /task/1           ----> mark task 1 as complete
//   {"is_completed": 1}
// PUT /task/1            ----> mark task 1 as incomplete
//   {"is_completed": 0}
// DELETE /task/1         ----> delete task 1
if($_SERVER["REQUEST_METHOD"] === "GET"){
    echo "GET";
    echo "<br>";
    echo $requestUri;
    echo "<br>";
    print_r($request);
    echo "<br>";

    $controller-> index();

}elseif($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "POST";
    $controller->addTask();
}elseif($_SERVER["REQUEST_METHOD"] === "PUT"){
    // echo "PUT";
    $id = end($request);
    $controller->updateTask($id);
}elseif($_SERVER["REQUEST_METHOD"] === "DELETE"){
    echo "DELETE";
    $id = end($request);
    $controller->deleteTask($id);
}else{
    // echo "ELSE";
    $controller-> index();
}