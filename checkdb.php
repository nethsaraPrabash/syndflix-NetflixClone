<?php
// Database connection code, replace with your own
$host = "localhost";
$username = "root";
$password = "Nethalk@123";
$database = "syndflix";

try {
    $con = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// SQL query to fetch data from the database
$query = $con->prepare("SELECT * FROM videos");
$query->execute();
$videos = $query->fetchAll(PDO::FETCH_ASSOC);

// Check if data was retrieved
if (count($videos) > 0) {
    echo "<h2>Videos Found:</h2>";
    foreach ($videos as $video) {
        echo "ID: " . $video['id'] . "<br>";
        echo "Title: " . $video['title'] . "<br>";
        echo "Description: " . $video['description'] . "<br>";
        echo "<video width='320' height='240' controls>";
        echo "<source src='" . $video['filePath'] . "' type='video/mp4'>";
        echo "Your browser does not support the video tag.";
        echo "</video>";
        echo "<hr>";
    }
} else {
    echo "No videos found in the database.";
}

// Close the database connection
$con = null;
?>
