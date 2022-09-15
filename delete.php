<?php 
 require_once 'db.php';
 $id = $_GET['id'];
 if((int)$id && !empty($id) ){

    $query = "DELETE FROM users  WHERE id = $id ";
    $result = mysqli_query($conn, $query);

    header("location:allusers.php");
 }