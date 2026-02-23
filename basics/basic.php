<?php
$name = "Braydon";
$a = (string) 5;
const hello = "Hello, World!";
echo 33+34;
echo nl2br("\n");//line break
var_dump($name);
echo nl2br("\n");
echo "Hello, " . $name . "!";
//////////////////////////////////////////////
$number = 10;
if ($number == "10"){
    echo nl2br("\n\n");
    echo "True";
}else{
    echo nl2br("\n\n");
    echo "False";
}
///////////////////////////////////////////////
echo nl2br("\n\n");
$fruits = array("Apple", "Banana", "Orange");
$fruit = ["Banana"];

var_dump($fruits);
echo nl2br("\n");
var_dump($fruit);

///////////////////////////////////////////////
$fruits[] = "Grapes";
echo nl2br("\n");
foreach($fruits as $item){
    echo nl2br("\n");
    echo $item;
}
echo nl2br("\n\n");
print_r($fruits);
///////////////////////////////////////////////
$person = [
    "name" => "Braydon",
    "age" => 21,
];
echo nl2br("\n");
foreach($person as $key => $value){
    echo nl2br("\n");
    echo $value;
};



?>