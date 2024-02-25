<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "Nethalk@123";
$dbname = "syndflix";

try {
    $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}

// Check if ID is provided in the URL
if(!isset($_GET["id"])) {
    exit("No ID passed into page");
}

// Get the video ID from the URL parameter
$videoId = $_GET["id"];

// Check if the video ID exists in the database
$query = $con->prepare("SELECT * FROM videos WHERE id = :id");
$query->bindValue(":id", $videoId);
$query->execute();

if ($query->rowCount() === 0) {
    exit("Video not found");
}

// Fetch the video data
$videoData = $query->fetch(PDO::FETCH_ASSOC);

// Define the Video class
class Video {
    private $con, $sqlData;

    public function __construct($con, $input) {
        $this->con = $con;

        if(is_array($input)) {
            $this->sqlData = $input;
        }
        else {
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindValue(":id", $input);
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getTitle() {
        return $this->sqlData["title"];
    }

    public function getDescription() {
        return $this->sqlData["description"];
    }

    public function getFilePath() {
        return $this->sqlData["filePath"];
    }

    public function incrementViews() {
        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindValue(":id", $this->sqlData["id"]);
        $query->execute();
    }
}

// Create a new Video object
$video = new Video($con, $videoId);
$video->incrementViews(); // Increment views when the video is viewed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Details</title>
</head>
<body  style="background-color: #000;">
    <h1 class="filmName" style="color: #f0f0f0;"><?php echo $video->getTitle(); ?></h1>
    <video controls autoplay>
        <source src="<?php echo $video->getFilePath(); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <p style="color: #f0f0f0; font-size: 20px"><?php echo $video->getDescription(); ?></p>
</body>
</html>