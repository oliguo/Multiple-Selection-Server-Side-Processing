<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mass_selects_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

mysqli_query($conn, "truncate table items");


// List of sample fruit names
$baseNames = ["Apple", "Banana", "Orange", "Grape", "Strawberry", "Pineapple", "Mango", "Blueberry", "Peach", "Cherry"];


// Generate 150,000 unique items
$items = [];
$sqls = [];
for ($i = 0; $i < 150000; $i++) {
    $id = $i + 1;
    $name = $baseNames[$i % count($baseNames)] . "_" . ($id);
    $item = ["id" => $id, "name" => $name];
    array_push($items, $item);
    array_push($sqls, "('" . $id . "','" . $name . "')");
}
$sql="insert into items(id,name)values" . implode(',', $sqls);
// echo $sql;
mysqli_query($conn, $sql);


// echo json_encode($items, JSON_PRETTY_PRINT);