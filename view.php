<?php
 require_once 'db.php';
require_once 'inc/header.php';

$id = $_GET['id'];

if((int)$id && !empty($id) ){
   
    $query = "SELECT id, lname,fname,email,photo FROM users WHERE id = $id ";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
    }
}


?>

    <section class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header">
                            <h3>User : </h3>
                        </div>
                        <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Id</td>
                                <td>:</td>
                                <td><?= $user['id'] ?></td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td>:</td>
                                <td><?= $user['fname'] ?></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>:</td>
                                <td><?= $user['lname'] ?></td>
                            </tr>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
    require_once 'inc/footer.php';
