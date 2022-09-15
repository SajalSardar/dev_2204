<?php 

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
                $success = "Inser Successfull!";
            }

        }else{
            $error["photoErr"] = "Photo Not Uploaded!";
        }
        
    }

}
   

    require_once 'inc/header.php';
?>

    <section class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                <?php 
                    if(isset($success)){
                        printf('<div class="alert alert-success"> %s </div>', $success);
                    }
                ?>

                    <div class="card">
                        <div class="card-header">
                            <h3>Sign Up</h3>
                        </div>
                        <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" >
                                <?php 
                                    if(isset($error["fnameErr"])){
                     printf('<p class="text-danger"> %s </p>', $error["fnameErr"]);
                                    } 
                                ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" class="form-control" name="photo">
                                <?php 
                                    if(isset($error["photoErr"])){
                     printf('<p class="text-danger"> %s </p>', $error["photoErr"]);
                                    } 
                                ?>
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
    require_once 'inc/footer.php';
