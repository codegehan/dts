<?php 
// Load the environment variables using dotenv
require dirname(__DIR__) . '/vendor/autoload.php';
use Dotenv\Dotenv;
// Create a new Dotenv instance and load the .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__)); // Specify the directory containing .env
$dotenv->load();
// Access the environment variables
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];
// Establish the database connection
$con = mysqli_connect($host, $user, $pass, $dbname, $port);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
