<?php 
 require_once 'db.php';
$id = $_GET['id'];


// seelct users 
if((int)$id && !empty($id) ){
   
    $query = "SELECT id, lname,fname,email,photo FROM users WHERE id = $id ";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
    }
}



// update user
$error = [];
if(isset($_POST['submit'])){

    $fname = trim(htmlentities($_POST['fname']));
    $lname = trim(htmlentities($_POST['lname']));
    $email = trim(htmlentities($_POST['email']));
    $photo = $_FILES['photo'];


    if(empty($fname)){
        $error["fnameErr"] =  "First Name Field is Empty!";
    }

    if(empty($lname)){
        $error["lnameErr"] = "Last Name Field is Empty!";
    }

    // insert image and remove old image 
    if($photo['name']){
        $photoEx = explode('.', $photo['name']);
        $photoName = $fname. '-'. uniqid().'.' .end($photoEx);

        $imagePath = "uploads/profile/". $user['photo'];
        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        $uploadPhoto = move_uploaded_file($photo['tmp_name'], 'uploads/profile/'. $photoName);

        $updateImageQuery = "UPDATE users SET photo = '$photoName'  WHERE id = $id";

        $updateImageResult = mysqli_query($conn, $updateImageQuery );
    }

    // insert all data 

    if(empty($error )){

        $updateQuery = "UPDATE users SET fname='$fname',lname='$lname',email='$email' WHERE id = $id";

        $updateResult = mysqli_query($conn, $updateQuery );
        if($updateResult){
            $success = "Insert Successfull!";
            header("location:allusers.php");
        }

    }

};




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
                            <h3>Edit User</h3>
                        </div>
                        <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" value="<?=$user['fname']?>" >
                                <?php 
                                    if(isset($error["fnameErr"])){
                     printf('<p class="text-danger"> %s </p>', $error["fnameErr"]);
                                    } 
                                ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" value="<?=$user['lname']?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="<?=$user['email']?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" class="form-control" name="photo">
                                <?php 
                                    if(isset($error["photoErr"])){
                     printf('<p class="text-danger"> %s </p>', $error["photoErr"]);
                                    } 
                                ?>

                                <img  class="mt-3" src="uploads/profile/<?= $user['photo'];?>" alt="<?= $user['fname'];?>" width="100">
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
