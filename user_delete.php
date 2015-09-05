<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$project = "PDO|WebDevActivity";
require_once 'header.php';




//check isset add
$data = [];
if (isset($_GET['id'])) {
$id = htmlspecialchars($_GET['id']);
    require_once './connection.php';



// database connection
    $conn = new connection('guest_book', 'root', '1');
    $conn = $conn->connect();

  
// query
  
    $sql = "DELETE FROM `guest_book`.`posts` WHERE `posts`.`id` = :id";
    $q = $conn->prepare($sql);
    $q->execute([':id' => $id]);

//redirect to index.php
    header('Location: ' . 'index.php');
}
?>


<?php require_once './footer.php'; ?>