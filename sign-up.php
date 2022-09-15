<?php 
session_start();
    require_once 'inc/header.php';

?>

    <section class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                <?php 
                    if(isset($_SESSION['success'])){
                        printf('<div class="alert alert-success"> %s </div>', $_SESSION['success']);
                    }
                ?>

                    <div class="card">
                        <div class="card-header">
                            <h3>Sign Up</h3>
                        </div>
                        <div class="card-body">
                        <form action="sign-up-post.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" >
                                <?php 
                                    if(isset($_SESSION['error']["fnameErr"])){
                     printf('<p class="text-danger"> %s </p>', $_SESSION['error']["fnameErr"]);
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
                                    if(isset($_SESSION['error']["photoErr"])){
                     printf('<p class="text-danger"> %s </p>', $_SESSION['error']["photoErr"]);
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

    unset($_SESSION['success'] );
    unset($_SESSION['error']);
