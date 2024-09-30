<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

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

// Function to get parameter value from either GET or POST
function getParam($name, $default = '')
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    return isset($data[$name]) ? $data[$name] : $default;
  } else {
    return isset($_GET[$name]) ? $_GET[$name] : $default;
  }
}
// Get parameters
$keyword = getParam('keyword', '');
$page = getParam('page', 1);
$startIndex = getParam('startIndex', 0);
$limit = getParam('limit', 20);
$category = getParam('category', '');
$sortField = getParam('sortField', 'id');
$sortOrder = getParam('sortOrder', 'ASC');
$itemIds = getParam('itemIds', '');

// Validate and sanitize sort field and order
$allowedSortFields = ['id', 'name', 'price', 'category']; // Add all allowed fields
$sortField = in_array($sortField, $allowedSortFields) ? $sortField : 'id';
$sortOrder = (strtoupper($sortOrder) === 'DESC') ? 'DESC' : 'ASC';

// Build SQL query
$sql = "SELECT * FROM items";
$whereClauses = [];

if (!empty($keyword)) {
  $whereClauses[] = "name LIKE '%" . $conn->real_escape_string($keyword) . "%'";
}

if (!empty($category)) {
  $whereClauses[] = "category = '" . $conn->real_escape_string($category) . "'";
}

if (!empty($itemIds)) {
  $itemIdsArray = explode(',', $itemIds);
  $itemIdsArray = array_map('intval', $itemIdsArray); // Ensure all IDs are integers
  $itemIdsString = implode(',', $itemIdsArray);
  $whereClauses[] = "id IN ($itemIdsString)";
}

if (!empty($whereClauses)) {
  $sql .= " WHERE " . implode(" AND ", $whereClauses);
}

$sql .= " ORDER BY " . $conn->real_escape_string($sortField) . " " . $sortOrder;
$sql .= " LIMIT $startIndex, $limit";

// Execute the query
$result = $conn->query($sql);

// Calculate total pages
$sqlTotal = "SELECT COUNT(*) AS total FROM items";
if (!empty($whereClauses)) {
  $sqlTotal .= " WHERE " . implode(" AND ", $whereClauses);
}
$resultTotal = $conn->query($sqlTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch data and store in an array
$options = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $options[] = $row;
  }
}

// Return the data as JSON
$response = [
  'options' => $options,
  'totalPages' => $totalPages,
  'currentPage' => $page,
  'sortField' => $sortField,
  'sortOrder' => $sortOrder
];

header('Content-type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
