

<?php
require_once("header.php");


$preview = new PreviewProvider($conn, $userLoggedIn);

echo $preview->createPreviewVideo(null);

$preview = new CategoryContainer($conn, $userLoggedIn);
echo $preview->showAllCategories();


?>
