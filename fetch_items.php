<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mass_selects_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get search keyword, page number, start index, and limit
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startIndex = isset($_GET['startIndex']) ? $_GET['startIndex'] : 0;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 20;

// Build SQL query with search, pagination, start index/limit, and order by ID
$sql = "SELECT * FROM items";
if (!empty($keyword)) {
  $sql .= " WHERE name LIKE '%" . $conn->real_escape_string($keyword) . "%'";
}
$sql .= " ORDER BY id ASC LIMIT $startIndex, $limit"; // Order by ID ASC

// Execute the query
$result = $conn->query($sql);

// Calculate total pages
$sqlTotal = "SELECT COUNT(*) AS total FROM items";
if (!empty($keyword)) {
  $sqlTotal .= " WHERE name LIKE '%" . $conn->real_escape_string($keyword) . "%'";
}
$resultTotal = $conn->query($sqlTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch data and store in an array
$options = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $options[] = $row;
  }
}

// Return the data as JSON
$response = [
  'options' => $options,
  'totalPages' => $totalPages,
  'currentPage' => $page
];

header('Content-type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>