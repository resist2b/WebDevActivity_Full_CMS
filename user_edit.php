<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$project = "PDO|WebDevActivity";
require_once 'header.php';
require_once './connection.php';
$conn = new connection('guest_book', 'root', '1');
$pdo = $conn->connect();




//check isset add
$data = [];
if (isset($_POST['update'])) {

    require_once './connection.php';



// database connection
    $conn = new connection('guest_book', 'root', '1');
    $conn = $conn->connect();



    $data['Name'] = htmlspecialchars($_POST['Name']);
    $data['Email'] = htmlspecialchars($_POST['Email']);
    $data['url'] = htmlspecialchars($_POST['url']);
    $data['title'] = htmlspecialchars($_POST['title']);
    $data['comment'] = htmlspecialchars($_POST['comment']);
    $data['img'] = htmlspecialchars($_POST['img']);



// query

    $sql = "UPDATE posts SET name=?, email=?,url=?,title=?,comment=?,img=? WHERE id=?";
   

    $q = $conn->prepare($sql);
    $q->execute(array(
        $data['Name'],
        $data['Email'],
        $data['url'],
        $data['title'],
        $data['comment'],
        $data['img'],
        $_GET['id'],
    ));




//redirect to index.php
    header('Location: ' . 'index.php');
}
?>
<div class="row">

    <h1>Edit user</h1>
    <div class="col-lg-4">

        <?php
        try {
            $id = htmlspecialchars($_GET['id']);
            $data = $pdo->prepare("SELECT * FROM  `posts`  WHERE `id`= :id");
            $data->bindParam(':id', $id, PDO::PARAM_INT);
            $data->execute([":id" => $id]);
            $row = $data->fetch();

            if ($data->rowCount() > 0) {
                ?>


                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                    <label for="Name">Name</label>
                    <input class="form-control" type="text" value="<?php echo $row->name; ?>" name="Name" id=""/>
                    <label for="Email">Email</label>
                    <input class="form-control" type="text"  value="<?php echo $row->email; ?>" name="Email" id=""/>
                    <label for="url">url</label>
                    <input class="form-control" type="text" value="<?php echo $row->url; ?>" name="url" id=""/>
                    <label for="title">title</label>
                    <input class="form-control" type="text" value="<?php echo $row->title; ?>"  name="title" id=""/>
                    <label for="comment">comment</label>
                    <textarea class="form-control" type="text" name="comment" id=""><?php echo $row->comment; ?></textarea>
                    <label for="title">img</label>
                    <input class="form-control" type="text" value="<?php echo $row->img; ?>" name="img" id=""/>
                    <br>
                    <input class="btn btn-success" value="update" type="submit" name="update" id=""/>
                    <!--<input class="btn btn-danger" value="clear" type="reset" id=""/>-->
                    <!--<input class="form-control" type="hidden" name="security" id=""/>-->
                </form>


                <?php
            } else {
                echo "no data";
            }
        } catch (PDOException $e) {
            echo "Fetching Data ERROR: " . $e->getMessage();
        }
        ?>

    </div>

</div>

<?php require_once './footer.php'; ?>