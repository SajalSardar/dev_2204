<?php 
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "webdev_2204");

$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if(!$conn){
    echo "Database Connection Error!";
}