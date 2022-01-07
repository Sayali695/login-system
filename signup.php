<?php
$sqlrun = false;
$showError = "";
include 'partials/db_connect.php';
// echo ($_SERVER['REQUEST_METHOD']);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $usernamee = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $existsql = "Select * from users where username='$usernamee'";
    $result = mysqli_query($conn, $existsql);
    $numexistsRows=mysqli_num_rows($result);

    if($numexistsRows>0){
      // $exists=true;
      $showError="Username already exists.";
    }
    else{
      if($password == $cpassword){
        $hash_password=password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` (`username`, `password`
          ) VALUES ('$usernamee', '$hash_password')";
          $result = mysqli_query($conn, $sql);
          if($result){
              $sqlrun = true;
          }
      }
      else{
        $showError="Passwords do not match";
      }
  }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sign Up System</title>
  </head>
  <body>
    <?php
    require "partials/_nav.php";
    ?>
<?php
    if($showError){
      echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!!!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    else if($sqlrun){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have successfully signed up.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    
?>
    <div class="container">
    <h1 class = "text-center">Sign Up to Our Website!!!</h1>
    <form action="/login_sys/signup.php" method="post">
  <div class="mb-3 col-md-6">
    <label for="username" class="form-label" >Username</label>
    <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
  </div>

  <div class="mb-3 col-md-6">
    <label for="password" class="form-label" >Password</label>
    <input type="password" class="form-control" name = "password" id = "password">
  </div>
  <div class="mb-3 col-md-6">
    <label for="cpassword" class="form-label" > Confirm Password</label>
    <input type="password" class="form-control" name = "cpassword" id="cpassword">
    <div id="emailHelp" class="form-text">Make sure to enter same password.</div>
  </div>


  <button type="submit" class="btn btn-primary">Sign Up</button>

</form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>