<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$project = "PDO|WebDevActivity";
require_once 'header.php';




//check isset add
$data = [];
if (isset($_POST['add'])) {

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
    $sql = "INSERT INTO `posts`( `name`, `email`, `url`, `title`, `comment`, `img`) VALUES (:name,:email,:url,:title,:comment,:img)";
    $q = $conn->prepare($sql);
    $q->execute(array(':name' => $data['Name'],
        ':email' => $data['Email'],
        ':url' => $data['url'],
        ':title' => $data['title'],
        ':comment' => $data['comment'],
        ':img' => $data['img'],
    ));

//redirect to index.php
    header('Location: ' . 'index.php');
}
?>
<div class="row">

    <h1>insert new user</h1>
    <div class="col-lg-4">


        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

            <label for="Name">Name</label>
            <input class="form-control" type="text" name="Name" id=""/>
            <label for="Email">Email</label>
            <input class="form-control" type="text" name="Email" id=""/>
            <label for="url">url</label>
            <input class="form-control" type="text" name="url" id=""/>
            <label for="title">title</label>
            <input class="form-control" type="text" name="title" id=""/>
            <label for="comment">comment</label>
            <textarea class="form-control" type="text" name="comment" id=""></textarea>
            <label for="title">img</label>
            <input class="form-control" type="text" name="img" id=""/>
            <br>
            <input class="btn btn-success" value="add" type="submit" name="add" id=""/>
            <input class="btn btn-danger" value="clear" type="reset" id=""/>
            <input class="form-control" type="hidden" name="security" id=""/>
        </form>




    </div>

</div>

<?php require_once './footer.php'; ?>