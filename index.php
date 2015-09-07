<?php

namespace APP\DB;

$project = "PDO|WebDevActivity";
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'header.php';
require_once 'APP/DB/db.php';
//creating DB Object
$db = new DB('guest_book', 'root', '1');
// creating PDO Object
$conn = $db->connect();




if (!$conn) {
    die('Error in DB Connection');
} else {

    try {
//PDOStatement Object
        $data = $db->query('SELECT * FROM  `posts', [], $conn);

        if ($data->rowCount() > 0) {
            ?>
            <!--Build Web page-->
            <h1>Num Of Records : <?php echo $data->rowCount(); ?></h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>                   
                        <th>url</th>
                        <th>title</th>
                        <th>comment</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><?= $row->name ?></td>
                            <td><?= $row->email ?></td>            
                            <td><?= $row->url ?></td>
                            <td><?= $row->title ?></td>
                            <td><?= $row->comment ?></td>
                            <td>
                                <A title="<?= $row->name ?>" href="user.php?id=<?= $row->id ?>">View</A>
                                <A title="<?= $row->name ?>" href="user_edit.php?id=<?= $row->id ?>">Edit</A>
                                <A title="<?= $row->name ?>" href="user_delete.php?id=<?= $row->id ?>">Delete</A>
                            </td>



                        </tr>
                    <?php endforeach; ?>



                </tbody>
            </table>

            <?php
        }
        else {
            echo 'no data ';
        }
    } catch (PDOException $e) {
        echo "Fetching Data ERROR: " . $e->getMessage();
        echo "mezo" . $data->errorInfo();
    }
}
?>



<?php
die();

//class
class movie {

    private $title;
    private $year;
    private $cast = [];

    function __construct($title, $year, array $cast) {
        $this->title = $title;
        $this->year = $year;
        $this->cast = $cast;
    }

    public function act() {
        return 'ana actor';
    }

}

$tito = new movie("Tito", 2005, ['Ahmed El-Sakam', 'Mona Zaky']);

echo "<pre>";
print_r($tito);
echo "</pre>";

//echo $tito->title; //Fatal error: Cannot access private property movie::$title in /var/www/html/WebDevActivity/index.php on line 32
//  -------------------------------------------------

echo "<hr>";
$hyafawda = new movie("Heya Fawda", 2006, ['Khaled Saleh', 'Mene ?']);

//unset($hyafawda);
echo "<pre>";
print_r($hyafawda);
echo "</pre>";

//  -------------------------------------------------

echo "<hr>";
$alwardaalbaydaa = new movie("AlWarda AlBaydaa", 1943, ['Mohammed Abd AlWahab', 'Unknown']);

//unset($hyafawda);
echo "<pre>";
print_r($alwardaalbaydaa);
echo "</pre>";
?>





<h2>OOP</h2>
<ul>
    <li>Inheritance</li>
    <li>encapsulation</li>
    <li>polymorphism</li>



</ul>





<?php require_once 'footer.php'; ?>
