<?php
session_start();
require_once 'db.php';
$error = [];

if(isset($_POST['submit'])){

    $fname = trim(htmlentities($_POST['fname']));
    $lname = trim(htmlentities($_POST['lname']));
    $email = trim(htmlentities($_POST['email']));
    $password = trim(htmlentities($_POST['password']));
    $md5pass = md5($password); 
    $photo = $_FILES['photo'];

    $photoEx = explode('.', $photo['name']);

    if(empty($fname)){
        $error["fnameErr"] =  "First Name Field is Empty!";
    }

    if(empty($lname)){
        $error["lnameErr"] = "Last Name Field is Empty!";
    }

    if(empty($photo['name'])){
        $error["photoErr"] = "Select Photo!";
    }

    
    

    if(empty($error)){

        $photoName = $fname. '-'. uniqid().'.' .end($photoEx);

        $uploadPhoto = move_uploaded_file($photo['tmp_name'], 'uploads/profile/'. $photoName);

        if($uploadPhoto){
            $query = "INSERT INTO users( fname, lname, email, password, photo) VALUES ('$fname', '$lname', '$email', '$md5pass', '$photoName')";

            $result = mysqli_query($conn, $query);

            if($result){
               $_SESSION['success'] = "Inser Successfull!";
            }

        }else{
            $error["photoErr"] = "Photo Not Uploaded!";
        }
        
    }else{
        $_SESSION['error'] = $error;
    }

}

header("location:sign-up.php");
