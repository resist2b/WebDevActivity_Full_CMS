<?php
namespace APP\DB;
use \PDO;
$project = "WebDevActivity";
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'header.php';
require_once 'APP/DB/db.php';
$conn = new DB('guest_book', 'root', '1');
$pdo = $conn->connect();
try {
    $id = htmlspecialchars($_GET['id']);
    $data = $pdo->prepare("SELECT * FROM  `posts`  WHERE `id`= :id");
    $data->bindParam(':id', $id, PDO::PARAM_INT);
    $data->execute([":id" => $id]);
    $row = $data->fetch();

    if ($data->rowCount() > 0) {
        ?>


        <article class="row">
            <div class="col-md-2 col-sm-2 hidden-xs">
                <figure class="thumbnail">
                    <img class="img-responsive" src="img/<?php echo $row->img ?>">
                    <figcaption class="text-center"><?php echo $row->name ?></figcaption>
                </figure>
            </div>
            <div class="col-md-10 col-sm-10">
                <div class="panel panel-default arrow left">
                    <div class="panel-body">
                        <header class="text-left">
                            <div class="comment-user"><i class="fa fa-user"></i> <h1><?php echo $row->title ?></h1></div>
                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $row->email ?></time>
                        </header>
                        <div class="comment-post">
                            <p>
        <?php echo $row->comment ?>
                            </p>
                        </div>
                        <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                    </div>
                </div>
            </div>
        </article>

        <?php
    }
 else {
        echo "no data";
    }
} catch (PDOException $e) {
    echo "Fetching Data ERROR: " . $e->getMessage();
}

require_once 'footer.php';
?>