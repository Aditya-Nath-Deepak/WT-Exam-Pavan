<?php
// Allow Cross-Origin Resource Sharing (CORS) for React
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Database credentials
$host = "localhost";
$user = "root";
$pass = ""; 
$dbname = "vit_results";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get the JSON data sent from React
$data = json_decode(file_get_contents("php://input"));

if(isset($data->name) && isset($data->course)) {
    $name = $conn->real_escape_string($data->name);
    $course = $conn->real_escape_string($data->course);
    $percentage = $conn->real_escape_string($data->percentage);
    $status = $conn->real_escape_string($data->status);

    $sql = "INSERT INTO records (name, course, percentage, status) VALUES ('$name', '$course', '$percentage', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Result saved to MySQL successfully!"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}
$conn->close();
?>