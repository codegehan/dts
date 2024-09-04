<?php 
require dirname(dirname(__DIR__)) . '/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

Class Option{
    public static function Populate($spname, $value, $description){
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $dbname = $_ENV['DB_NAME'];

        $connection = mysqli_connect($host, $user, $pass, $dbname,$port);
        $sql = "call $spname()";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        while($row = $res->fetch_assoc()) {
            echo "<option value='" . $row[$value] . "'>" . strtoupper($row[$description]) . "</option>";
        }
        $stmt->close();
    }
}
?>
