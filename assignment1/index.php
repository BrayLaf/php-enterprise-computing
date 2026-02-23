<?php 
    include "controller/BookController.php";

    $controller = new BookController();

    $requestURi = $_SERVER['REQUEST_URI'];
    $request = explode("/", trim($requestURi, "/"));

    //GET / gets all books
    // Post /book adds new book

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $controller->getBooks();
    }elseif($_SERVER["REQUEST_METHOD"] === "POST"){
        $controller->newBook();
    }else{
        $controller->getBooks();
    }


?>