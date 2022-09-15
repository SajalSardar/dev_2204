<?php 
 require_once 'db.php';
 
 $id = $_GET['id'];
 
 if((int)$id && !empty($id) ){
    
     $query = "SELECT id, status FROM users WHERE id = $id ";
     $result = mysqli_query($conn, $query);
     
     if(mysqli_num_rows($result) > 0){
         $user = mysqli_fetch_assoc($result);
     }


     if($user['status'] == 1){

        $updateQuery = "UPDATE users SET status = 2  WHERE id = $id";
        $updateresult = mysqli_query($conn, $updateQuery);
     }else{

        $updateQuery = "UPDATE users SET status = 1  WHERE id = $id";
        $updateresult = mysqli_query($conn, $updateQuery);
     }
     header("location:allusers.php");

 }