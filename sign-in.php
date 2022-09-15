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
                            <h3>Sign In</h3>
                        </div>
                        <div class="card-body">
                        <form action="sign-in-post.php" method="POST">
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
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

